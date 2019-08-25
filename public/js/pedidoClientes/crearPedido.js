$(document).ready(function () {
  let $datos_pedido = $('#datos-pedido :input');
  let $datos_producto = $('#datos-producto :input');
  let $cliente = $('#cliente');
  let $producto = $('#producto');

  $datos_pedido.prop('disabled', true);
  $datos_producto.prop('disabled', true);
  inicializarSelect2($cliente, 'Ingrese la razon social', '');
  fechaActual();
  validateDates();

  $cliente.on('change', function () {
    let id = $cliente.val();
    let deshabilitar = true;
    if (id) {
      getClienteById(id).done((data) => {
        $('#ruc').val(data.cliente.ruc);
        if (data.total_consumido >= data.cliente.linea_credito) {
          toastr.info('El cliente ha excedido la linea de credito', 'Info Alert', { timeOut: 3000 });
        }
      }).fail((error) => {
        toastr.error('Ocurrio un Error!', 'Error Alert', { timeOut: 2000 });
      });
      deshabilitar = false;
    } else {
      $('#ruc').val('');
    }
    $datos_pedido.prop('disabled', deshabilitar);
    $datos_producto.prop('disabled', deshabilitar);
  });

  $producto.on('keyup', function () {
    var total = 0;
    var galones = $('#galones').val();
    var precio = $('#precio_galon').val();
    total = galones * precio;
    total = parseFloat(total).toFixed(2);
    $('#saldo').val(total);
  });
});


function fechaActual() {
  $('#fecha_pedido').val($.datepicker.formatDate('d/m/yy', new Date()));
}

function validateDates() {
  $('#fecha_descarga').datepicker({
    minDate: 0,
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

function getAllClientesByTipo(tipo) {
  return $.ajax({
    type: 'GET',
    url: `../clientes/tipo/${tipo}`,
    dataType: 'json'
  });
}

function getClienteById(id) {
  return $.ajax({
    type: 'GET',
    url: `../clientes/${id}`,
    dataType: 'json',
  });
}
