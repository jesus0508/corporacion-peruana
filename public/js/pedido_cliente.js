$('#modal-edit-pedido_cliente').on('show.bs.modal', function (event) {
  var id = $(event.relatedTarget).data('id');
  $.ajax({
    type: 'GET',
    url: `./pedido_clientes/${id}/edit`,
    dataType: 'json',
    success: (data) => {
      $(event.currentTarget).find('#nro_pedido-edit').val(data.pedidoCliente.nro_pedido);
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
  var id = $(event.relatedTarget).data('id');
  $.ajax({
    type: 'GET',
    url: `./pedido_clientes/${id}`,
    dataType: 'json',
    success: (data) => {
      $(event.currentTarget).find('#cliente-show').val(data.pedidoCliente.cliente.razon_social);
      $(event.currentTarget).find('#ruc-show').val(data.pedidoCliente.cliente.ruc);
      $(event.currentTarget).find('#numero-show').val(data.pedidoCliente.cliente.telefono);
      $(event.currentTarget).find('#nro_pedido-show').val(data.pedidoCliente.nro_pedido);
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
  var fecha_pedido = 0;
  var id = $(event.relatedTarget).data('id');
  $.ajax({
    type: 'GET',
    url: `./pedido_clientes/${id}`,
    dataType: 'json',
    data: {
      'id': $('#id').val(),
    },
    success: (data) => {
      $(event.currentTarget).find('#nro_pedido-pago').val(data.pedidoCliente.nro_pedido);
      $(event.currentTarget).find('#pedido_cliente_id-pago').val(data.pedidoCliente.id);
      $(event.currentTarget).find('#saldo-pago').val(data.pedidoCliente.saldo);
      // fecha_pedido=$.datepicker.parseDate('d/m/yy',data.pedidoCliente.created_at);
    }
  });
  $('#fecha_operacion').datepicker({
    // minDate:fecha_pedido,
  });
});

$('form button[type=submit]').on('click', function (event) {
  var $saldo = $('#saldo-pago');
  var monto = $('#monto_operacion').val();
  if (monto > 0) {
    var newSaldo = $saldo.val() - monto;
    $saldo.val(newSaldo);
  }
  $('.pago').submit();
});

/**Activar/Desactivar Inputs del formulario */
$(document).ready(function () {
  $('#datos-pedido :input').prop('disabled', true);
  $('#datos-producto :input').prop('disabled', true);
  $('#cliente').prop('selectedIndex', -1);
  $('#cliente').select2({
    placeholder: 'Ingresa la razon social',
    allowClear: true
  });
  $('#cliente').on('change', function () {
    var id = $('#cliente').val();
    var deshabilitar = true;
    if (id) {
      findById(id);
      deshabilitar = false;
    } else {
      $('#ruc').val('');
    }
    $('#datos-pedido :input').prop('disabled', deshabilitar);
    $('#datos-producto :input').prop('disabled', deshabilitar);
  });

});

/**Inicializar DataTable */
$(document).ready(function () {
  $('#tabla-pedido_clientes').DataTable({
    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
    },
    dom: 'r<"pull-right"l>t<"bottom"ip><"clear">'
  });
});

/** Inicializar datos  */
$(document).ready(function () {
  fechaActual();
  calcularTotal();
  validateDates();
});

function calcularTotal() {
  $('#producto').on('keyup', function () {
    var total = 0;
    var galones = $('#galones').val();
    var precio = $('#precio_galon').val();
    total = galones * precio;
    total = parseFloat(total).toFixed(2);
    $('#saldo').val(total);
  });
}

function fechaActual() {
  $('#fecha_pedido').val($.datepicker.formatDate('d/m/yy', new Date()));
}

function validateDates() {
  $('#fecha_inicio').datepicker({
    numberOfMonths: 2,
    onSelect: function (selected) {
      $('#fecha_fin').datepicker('option', 'minDate', selected)
    }
  });
  $('#fecha_fin').datepicker({
    numberOfMonths: 2,
    onSelect: function (selected) {
      $('#fecha_inicio').datepicker('option', 'maxDate', selected)
    }
  });
  $('#fecha_descarga').datepicker({
    minDate: 0,
  });
}

$('.btn-eliminar').on('click', function (event) {
  event.preventDefault();
  var id = $(this).data('id');
  deletePedido(id);

});

/* AJAX Buscar por ID */
function findById(id) {
  $.ajax({
    type: 'GET',
    url: `../clientes/${id}`,
    dataType: 'json',
    success: (data) => {
      $('#ruc').val(data.cliente.ruc);
    }
  });
}

function updatePedido(id) {

}

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

$('.box').on('click', function () {
  $('.box').removeClass('box-success');
  $(this).addClass('box-success');
})


$('#tipo').on('change', function (event) {
  var $cliente = $('#cliente');
  var tipo = $(this).val();
  $.ajax({
    type: 'GET',
    url: `../clientes/tipo/${tipo}`,
    dataType: 'json',
    success: (data) => {
      $cliente.empty();
      $cliente.select2({
        placeholder: 'Ingresa la razon social',
        allowClear: true,
        data: data.clientes
      });
      $cliente.trigger('change')
    }
  });
});

$(document).ready(function () {

  $('#cliente-pago_bloque').prop('selectedIndex',-1);
  $('#cliente-pago_bloque').select2({
    placeholder: 'Ingresa la razon social',
    allowClear: true,
  });
  $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
      var cliente=$('#cliente-pago_bloque option:selected').text();
      var cliente_cell = data[2];
      if(cliente){
        return cliente===cliente_cell;
      }
      return true;
    }
  );

  $('#cliente-pago_bloque').on('change',function(){
    var cliente=$('#cliente-pago_bloque option:selected').text();
      if(cliente){
        $('#btn-pagar').prop('disabled',false);
        $('#tabla-pedido_clientes').DataTable().draw();
      }
  });


});

