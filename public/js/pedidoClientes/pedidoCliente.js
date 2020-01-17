$(document).ready(function () {
  let $filter_cliente = $('#filter-cliente');
  let $tabla_pedido_clientes = $('#tabla-pedido_clientes');

  $tabla_pedido_clientes.DataTable({
      columnDefs: [
         { visible: false, targets: [3,4,8] },
          { orderable: false, targets: -1},
          { searchable: false, targets: [-1]},
          { responsivePriority: 2, targets: [1,-2] },
          { responsivePriority: 1, targets: [0,2,-1] }
        ],
      "aaSorting": [],
      "dom": 'Blfrtip',
      "buttons": [
        {
          extend: 'excelHtml5',
          title: 'Pedidos Clientes',
          attr:  {
                title: 'Excel',
                id: 'excelButton'
            },
          text:     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
          className: 'btn btn-default',
          exportOptions:
            {
              columns:[0,1,2,3,4,5,6,7,8,9]
            }
         }
        ],

  });

  inicializarSelect2($filter_cliente, 'Ingrese la razon social', '');
  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      let cliente = $filter_cliente.find('option:selected').text();
      let cell = data[2];
      if (cliente) {
        return cliente === cell;
      }
      return true;
    }
  );

  $filter_cliente.on('change', function () {
    $tabla_pedido_clientes.DataTable().draw();
  });

  $('form button[type=submit]').on('click', procesarPago);

  $('.btn-eliminar').on('click', function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    deletePedido(id);
  });

  $('#modal-edit-pedido_cliente').on('show.bs.modal', function (event) {
    let id = $(event.relatedTarget).data('id');
    $.ajax({
      type: 'GET',
      url: `./pedido_clientes/${id}/edit`,
      dataType: 'json',
      success: (data) => {
        let factura_cliente = data.pedidoCliente.factura_cliente;
        let nro_factura = (factura_cliente)? factura_cliente.nro_factura : "Sin Factura";
        $(event.currentTarget).find('#nro_factura-edit').val(nro_factura);
        $(event.currentTarget).find('#galones-edit').val(data.pedidoCliente.galones);
        $(event.currentTarget).find('#precio_galon-edit').val(data.pedidoCliente.precio_galon);
        $(event.currentTarget).find('#fecha_descarga-edit').val(data.pedidoCliente.fecha_descarga);
        $(event.currentTarget).find('#horario_descarga-edit').val(data.pedidoCliente.horario_descarga);
        $(event.currentTarget).find('#observacion-edit').val(data.pedidoCliente.observacion);
        $(event.currentTarget).find('#id-edit').val(data.pedidoCliente.id);
      },
      error: (error) => {
        toastr.error('Ocurrio un Error!', 'Error Alert', { timeOut: 2000 });
      }
    });
    $('#fecha_descarga-edit').datepicker({
      //minDate: 0,
    });
  });

  $('#modal-show-pedido_cliente').on('show.bs.modal', function (event) {
    let id = $(event.relatedTarget).data('id');
    $.ajax({
      type: 'GET',
      url: `./pedido_clientes/${id}`,
      dataType: 'json',
      success: (data) => {
        //console.log(data.pedidoCliente);
        $(event.currentTarget).find('#cliente-show').val(data.pedidoCliente.cliente.razon_social);
        $(event.currentTarget).find('#ruc-show').val(data.pedidoCliente.cliente.ruc);
        $(event.currentTarget).find('#numero-show').val(data.pedidoCliente.cliente.telefono);
        const factura_cliente = data.pedidoCliente.factura_cliente;
        $(event.currentTarget).find('#nro_factura-show').val(factura_cliente ? factura_cliente.nro_factura : 'Sin asignar');
        $(event.currentTarget).find('#galones-show').val(data.pedidoCliente.galones);
        $(event.currentTarget).find('#precio_galon-show').val(data.pedidoCliente.precio_galon);
        $(event.currentTarget).find('#fecha_descarga-show').val(data.pedidoCliente.fecha_descarga);
        $(event.currentTarget).find('#horario_descarga-show').val(data.pedidoCliente.horario_descarga);
        $(event.currentTarget).find('#observacion-show').val(data.pedidoCliente.observacion);
        $(event.currentTarget).find('#fecha_pedido-show').val(data.pedidoCliente.created_at);
        $(event.currentTarget).find('#id-show').val(data.pedidoCliente.id);
        var total = parseFloat(data.pedidoCliente.galones * data.pedidoCliente.precio_galon).toFixed(2);
        $(event.currentTarget).find('#precio_total-show').val(total);
      },
      error: (error) => {
        toastr.error('Ocurrio un Error!', 'Error Alert', { timeOut: 2000 });
      }
    });
    $('#fecha_descarga-show').datepicker({
      minDate: 0,
    });
  });

  $('#modal-create-pago').on('show.bs.modal', function (event) {
    let fecha_pedido = 0;
    let id = $(event.relatedTarget).data('id');
    $.ajax({
      type: 'GET',
      url: `./pedido_clientes/${id}`,
      dataType: 'json',
      data: {
        'id': $('#id').val(),
      },
      success: (data) => {
        console.log(data);
        
        let factura_cliente = data.pedidoCliente.factura_cliente;
        let nro_factura = (factura_cliente)? factura_cliente.nro_factura : "Sin Factura";
        $(event.currentTarget).find('#nro_factura-pago').val(nro_factura);
        $(event.currentTarget).find('#pedido_cliente_id-pago').val(data.pedidoCliente.id);
        $(event.currentTarget).find('#saldo-pago').val(data.pedidoCliente.saldo);
        // fecha_pedido=$.datepicker.parseDate('d/m/yy',data.pedidoCliente.created_at);
      }
    });
    $('#fecha_operacion').datepicker({
      // minDate:fecha_pedido,
    });
    $('#fecha_reporte').datepicker({
      // minDate:fecha_pedido,
    });
  });

  $('#fecha_confirmacion-confirmar').datepicker({
  });

  $('#modal-confirmar_pedido').on('show.bs.modal', function (event) {
    let id = $(event.relatedTarget).data('id');
    $('#id-confirmar').val(id);
  });

  $('#modal-agregar_factura').on('show.bs.modal', function (event) {
    const id = $(event.relatedTarget).data('id');
    $('#id-agregar').val(id);
  });

  $('#fecha_factura-agregar').datepicker({
  });

});

  function confirmarDeletePedido()
{
  if(confirm('¿Estás seguro de eliminar pedido?'))
    return true;
  else
    return false;
}

function deletePedido(id) {
  let rpta = confirmarDeletePedido();
  if(rpta){
    $.ajax({
      type: 'DELETE',
      url: `./pedido_clientes/${id}`,
      dataType: 'json',
      data: {
        '_token': $('input[name="_token"]').val(),
      },
      success: (data) => {
        document.location.reload();
        toastr.success(data.status, 'Success Alert', { timeOut: 2000 });
      },
      error: (error) => {
        toastr.error('Ocurrio un Error!', 'Error Alert', { timeOut: 2000 });
      }
    });
  }

}

function inicializarSelect2($select, text, data) {
  $select.prop('selectedIndex', -1);
  $select.select2({
    placeholder: text,
    allowClear: true,
    data: data
  });
}



const procesarPago = function () {
  var $saldo = $('#saldo-pago');
  var monto = $('#monto_operacion').val();
  if (monto > 0) {
    var newSaldo = $saldo.val() - monto;
    $saldo.val(newSaldo);
  }
  $('.pago').submit();
}
