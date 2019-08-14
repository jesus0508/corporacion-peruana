$(document).ready(function () {
  let $modal_create_pago_bloque = $('#modal-create-pago_bloque');
  let $select_cliente = $('#seletc-clientes');
  let $datos_pago = $('#datos-pago :input').prop('disabled', true);

  $modal_create_pago_bloque.on('show.bs.modal', function (event) {
    let razon_social = $('#cliente-pago_bloque').find(':selected').text(); //Obtengo la razon social del cliente
    if (razon_social) {
      $('#razon_social-pago').val(razon_social);
      $select_cliente.prop('disabled', true);
      $datos_pago.prop('disabled', false);
    } else {
      let lista_clientes = '';
      getAllClientes().done((data) => {
        data.clientes.forEach((cliente) => {
          lista_clientes += `<option value="${cliente.id}">${cliente.razon_social}</option>`;
        });
        $select_cliente.html(lista_clientes);
        $select_cliente.prop('selectedIndex', -1);
        $select_cliente.select2({
          placeholder: 'Ingresa la razon social',
          allowClear: true,
        });
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
    let fecha_operacion = $('#fecha_operacion-pago_bloque').val();
    let codigo_operacion = $('#codigo_operacion-pago_bloque').val();
    let monto_operacion = $('#monto_operacion-pago_bloque').val();
    let banco_operacion = $('#banco-pago_bloque').val();
    let cliente_id = $select_cliente.val();
    let datos = {
      fecha: fecha_operacion,
      codigo: codigo_operacion,
      monto: monto_operacion,
      banco: banco_operacion,
      id: cliente_id,
    }
    pagarEnBloque(datos).done((data) => {
      console.log(data);
      limpiarInputs($datos_pago);
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
  console.log(datos)
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

