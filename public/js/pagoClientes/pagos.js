$(document).ready(function () {
  let $modal_create_pago_bloque = $('#modal-create-pago_bloque');
  let $select_cliente = $('#seletc-clientes');
  let $datos_pago = $('#datos-pago :input').prop('disabled', true);
  let $filter_cliente = $('#filter-cliente');
  let $tabla_pagos = $('#tabla-pagos');
  validateDates();

  $tabla_pagos.DataTable({
    language: {
       url : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
    }, 
  });

  $modal_create_pago_bloque.on('show.bs.modal', function (event) {
    let id = $filter_cliente.val(); //Obtengo la razon social del cliente
    let razon_social = $filter_cliente.find(':selected').text(); //Obtengo la razon social del cliente
    if (razon_social) {
      $select_cliente.html(`<option value="${id}">${razon_social}</option>`);
      $select_cliente.prop('disabled', true);
      $select_cliente.trigger('change');
      $datos_pago.prop('disabled', false);
    } else {
      let lista_clientes = '';
      getAllClientes().done((data) => {
        data.clientes.forEach((cliente) => {
          lista_clientes += `<option value="${cliente.id}">${cliente.razon_social}</option>`;
        });
        $select_cliente.html(lista_clientes);
        inicializarSelect2($select_cliente, 'Ingrese la razon social');
        $datos_pago.prop('disabled', false);
      }).fail((error) => {
        toastr.error('Ocurrior en el servidor', 'Error Alert', { timeOut: 2000 });
      })
    }
  });

  $select_cliente.on('change', function () {
    let idCliente = $select_cliente.val();
    if (idCliente) {
      getAllPedidosByCliente(idCliente).done((data) => {
        if (data.total_deuda != null) {
          $datos_pago.prop('disabled', false);
          $('#saldo-pago_bloque').val((data.total_deuda).toFixed(2));
          $('#cliente_id-pago_bloque').val(data.cliente_id);
        }
      }).fail((error) => {
        toastr.error('Ocurrior en el servidor', 'Error Alert', { timeOut: 2000 });
      });
    } else {
      $datos_pago.prop('disabled', true);
      limpiarInputs($datos_pago);
    }
  });

  $('#btn-pago-bloque').on('click', function () {
    let pagoData = {
      fecha: $('#fecha_operacion-pago_bloque').val(),
      codigo: $('#codigo_operacion-pago_bloque').val(),
      monto: $('#monto_operacion-pago_bloque').val(),
      banco: $('#banco-pago_bloque').val(),
      id: $select_cliente.val(),
    }
    pagarEnBloque(pagoData).done((data) => {
      limpiarInputs($datos_pago);
      document.location.reload();
      toastr.success(data.status, 'Success Alert', { timeOut: 2000 });
    }).fail((jqXHR) => {
      toastr.error('Ocurrior en el servidor', 'Error Alert', { timeOut: 2000 });
    })
  });
});

function getAllPedidosByCliente(id) {
  return $.ajax({
    type: 'GET',
    url: `./pedido_clientes/cliente/${id}`,
    dataType: 'json'
  });
}

function getAllClientes() {
  return $.ajax({
    type: 'GET',
    url: './clientes/all',
    dataType: 'json'
  });
}

function pagarEnBloque(datos) {
  return $.ajax({
    headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
    type: 'POST',
    url: `./pago_clientes/pedidos/${datos.id}`,
    dataType: 'json',
    data: {
      'fecha_operacion': datos.fecha,
      'codigo_operacion': datos.codigo,
      'monto_operacion': datos.monto,
      'banco': datos.banco
    }
  });
}

function limpiarInputs($container) {
  $container
    .not(':button, :submit, :reset, :hidden')
    .val('')
    .prop('checked', false)
    .prop('selected', false);
}

function inicializarSelect2($select, text) {
  $select.prop('selectedIndex', -1);
  $select.select2({
    placeholder: text,
    allowClear: true,
  });
}

function validateDates() {
  let $tabla_pagos = $('#tabla-pagos');
 
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

  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $('#fecha_inicio').val();
      var sFin = $('#fecha_fin').val();
      var inicio = $.datepicker.parseDate('d/m/yy', sInicio);
      var fin = $.datepicker.parseDate('d/m/yy', sFin);
      var dia = $.datepicker.parseDate('d/m/yy', data[1]);
      if (!inicio || !dia || fin >= dia && inicio <= dia) {
        return true;
      }
      return false;
    }
  );

  $('#filtrar-fecha').on('click', function () {
    $tabla_pagos.DataTable().draw();
  });
}