$(document).ready(function () {
  let $filter_cliente = $('#filter-cliente');
  let $tabla_pedido_clientes = $('#tabla-pedido_clientes');

  $tabla_pedido_clientes.DataTable({
    language: {
       url : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
    }, 
    columnDefs: [ 
    { 
      orderable: false, 
      targets: [ -1 ] 
    },
    { 
      searchable: false, 
      targets: [-1] 
    },
    ] 
  });

  inicializarSelect2($filter_cliente, 'Ingrese la razon social', '');
  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      let cliente = $filter_cliente.find('option:selected').text();
      let cell = data[1];
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

  $('.btn-eliminar').on('click', eliminarPedido.bind(event));

  $('#modal-edit-pedido_cliente').on('show.bs.modal', function (event) {
    let id = $(event.relatedTarget).data('id');
    $.ajax({
      type: 'GET',
      url: `./pedido_clientes/${id}/edit`,
      dataType: 'json',
      success: (data) => {
        $(event.currentTarget).find('#nro_factura-edit').val(data.pedidoCliente.nro_factura);
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
      minDate: 0,
    });
  });

  $('#modal-show-pedido_cliente').on('show.bs.modal', function (event) {
    let id = $(event.relatedTarget).data('id');
    $.ajax({
      type: 'GET',
      url: `./pedido_clientes/${id}`,
      dataType: 'json',
      success: (data) => {
        $(event.currentTarget).find('#cliente-show').val(data.pedidoCliente.cliente.razon_social);
        $(event.currentTarget).find('#ruc-show').val(data.pedidoCliente.cliente.ruc);
        $(event.currentTarget).find('#numero-show').val(data.pedidoCliente.cliente.telefono);
        $(event.currentTarget).find('#nro_factura-show').val(data.pedidoCliente.nro_factura);
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
        $(event.currentTarget).find('#nro_factura-pago').val(data.pedidoCliente.nro_factura);
        $(event.currentTarget).find('#pedido_cliente_id-pago').val(data.pedidoCliente.id);
        $(event.currentTarget).find('#saldo-pago').val(data.pedidoCliente.saldo);
        // fecha_pedido=$.datepicker.parseDate('d/m/yy',data.pedidoCliente.created_at);
      }
    });
    $('#fecha_operacion').datepicker({
      // minDate:fecha_pedido,
    });
  });

  $('#fecha_confirmacion-confirmar').datepicker({
  });

  $('#modal-confirmar_pedido').on('show.bs.modal', function (event) {
    let id = $(event.relatedTarget).data('id');
    $('#id-confirmar').val(id);
  });

});

function deletePedido(id) {
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

const eliminarPedido = function (event) {
  event.preventDefault();
  var id = $(this).data('id');
  deletePedido(id);
}