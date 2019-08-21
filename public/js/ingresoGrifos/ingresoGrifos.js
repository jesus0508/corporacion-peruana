$(document).ready(function () {
  let $select_grifo = $('#seletc-grifos');
  let $tabla_ingreso_grifos = $('#tabla-ingreso_grifos');
  let $modal_create_ingreso = $('#modal-create-ingreso');
  let $lecturas = $('#lecturas');
  let $lectura_inicial = $('#lectura_inicial');
  let $lectura_final = $('#lectura_final');
  let $total_galones = $('#total-galones');
  let $venta = $('#venta');
  let $calibracion = $('#calibracion');
  let $precio_galon = $('#precio_galon');

  inicializarDataTable($tabla_ingreso_grifos);

  $modal_create_ingreso.on('show.bs.modal', function (event) {
    getAllGrifos().done((data) => {
      inicializarSelect2($select_grifo, 'Seleccione el grifo', data.grifos);
    })
      .fail((error) => {
        toastr.error('Ocurrio un error en el servidor al guardar', 'Error Alert', { timeOut: 2000 });
      });
  });

  $select_grifo.on('change', function (event) {
    let idGrifo = $select_grifo.val();
    getIngresoByGrifo(idGrifo).done((data) => {
      $lectura_inicial.val(data.ingresoGrifo.lectura_inicial);
      //Cambiar a otra promesa
      $lecturas.trigger('keyup');
    }).fail((error) => {
      toastr.error('Ocurrio un error en el servidor!', 'Error Alert', { timeOut: 2000 });
    });
  });

  $lecturas.on('keyup', function (event) {
    let lectura_inicial = $lectura_inicial.val();
    let lectura_final = $lectura_final.val();
    let total = parseFloat(lectura_final - lectura_inicial).toFixed(2);
    $venta.val(total);
    $total_galones.trigger('keyup');
  });

  $total_galones.on('keyup', function (event) {
    $precio_galon.trigger('keyup');
  });

  $precio_galon.on('keyup',function(event){
    let venta = parseFloat($venta.val());
    let calibracion = parseFloat($calibracion.val());
    let precio_galon = parseFloat($precio_galon.val());
   
    let totalGalones = venta + calibracion;
    let precioTotal = (totalGalones * precio_galon).toFixed(2);

    $('#total').val(precioTotal);
  })
});

function inicializarSelect2($select, text, data) {
  $select.select2({
    placeholder: text,
    allowClear: true,
    data: data
  });
  $select.prop('selectedIndex', -1);
}

function inicializarDataTable($table) {
  $table.DataTable({
    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
    },
    columnDefs: [
      {
        orderable: false,
        targets: [-1]
      },
      {
        searchable: false,
        targets: [-1]
      },
    ]
  });
}

function getAllGrifos() {
  return $.ajax({
    type: 'GET',
    url: './grifos/all',
    dataType: 'json',
  });
}

function getIngresoByGrifo(idGrifo) {
  return $.ajax({
    type: 'GET',
    url: `./ingreso_grifos/grifo/${idGrifo}`,
    dataType: 'json',
  });
}

