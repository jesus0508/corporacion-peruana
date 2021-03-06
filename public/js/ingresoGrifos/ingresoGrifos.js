$(document).ready(function () {
  let $select_grifo = $('#seletc-grifos');
  let $tabla_ingreso_grifos = $('#tabla-ingreso_grifos');
  let $modal_create_ingreso = $('#modal-create-ingreso');
  let $fecha_ingreso = $('#fecha_ingreso');
  let $lecturas = $('#lecturas');
  let $lectura_inicial = $('#lectura_inicial');
  let $lectura_final = $('#lectura_final');
  let $total_galones = $('#total-galones');
  let $venta = $('#galones');
  let $calibracion = $('#calibracion');
  let $precio_galon = $('#precio_galon');
  let $fecha_inicio = $('#fecha_inicio');
  let $fecha_fin = $('#fecha_fin');

  inicializarDataTable($tabla_ingreso_grifos);

  $fecha_ingreso.datepicker({
    dateFormat: 'd-m-yy',
    maxDate: 0,
  });

  validateDates();

  $('#filtrar-fecha').on('click', function () {
    $tabla_ingreso_grifos.DataTable().draw();
  });

  $modal_create_ingreso.on('show.bs.modal', function (event) {
    hoy = $.datepicker.formatDate('d-m-yy', new Date());
    fillSelectGrifos(hoy);
  });

  $fecha_ingreso.on('change', function (event) {
    fecha_ingreso = $fecha_ingreso.val();
    fillSelectGrifos(fecha_ingreso);
  })

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

  $precio_galon.on('keyup', function (event) {
    let venta = parseFloat($venta.val());
    let calibracion = parseFloat($calibracion.val());
    let precio_galon = parseFloat($precio_galon.val());

    let totalGalones = venta - calibracion;
    let precioTotal = (totalGalones * precio_galon).toFixed(2);

    $('#monto_ingreso').val(precioTotal);
  })

  function fillSelectGrifos(fecha = '') {
    getAllGrifos(fecha)
      .done((data) => {

        $select_grifo.html('');
        inicializarSelect2($select_grifo, 'Seleccione el grifo', data.grifos);
      })
      .fail((error) => {
        toastr.error('Ocurrio un error en el servidor al guardar', 'Error Alert', { timeOut: 2000 });
      });
  }

  function validateDates() {
    $tabla_ingreso_grifos.DataTable().draw()
    $fecha_inicio.datepicker({
      numberOfMonths: 2,
      onSelect: function (selected) {
        $fecha_fin.datepicker('option', 'minDate', selected)
      }
    });
    $fecha_fin.datepicker({
      numberOfMonths: 2,
      onSelect: function (selected) {
        $fecha_inicio.datepicker('option', 'maxDate', selected)
      }
    });
  }

  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $fecha_inicio.val();
      var sFin = $fecha_fin.val();
      var inicio = $.datepicker.parseDate('d/m/yy', sInicio);
      var fin = $.datepicker.parseDate('d/m/yy', sFin);
      var dia = $.datepicker.parseDate('d/m/yy', data[1]);
      if (!inicio || !dia || fin >= dia && inicio <= dia) {
        return true;
      }
      return false;
    }
  );

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
    columnDefs: [
      {
        orderable: false,
        targets: [-1]
      },
      {
        searchable: false,
        targets: [-1]
      },
    ],"dom": 'Bfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Ingresos Grifos',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default',
        customize: function( xlsx ) {
              var sheet = xlsx.xl.worksheets['sheet1.xml'];
              let rels = xlsx.xl.worksheets['sheet1.xml'];
              var clR = $('row', sheet); 
              
              let nRows = clR.length;
              let total = $('c[r=F'+nRows+'] t', sheet).text();                
              $('row:last c t', sheet).text( '' );
              $('c[r=F'+nRows+'] t', sheet).text('TOTAL:' );
              $('c[r=F'+nRows+'] t', sheet).attr('s','37');
              $('c[r=G'+nRows+'] t', sheet).text( total );
              $('c[r=G'+nRows+'] t', sheet).attr('s','37');             
            },
        'exportOptions':
        {
          columns:[1,2,3,4,5,6,7]
        },
        footer: true
      }], 

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Total over all pages
            total = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);
            // Update footer
            $( api.column( 7 ).footer() ).html(
                pageTotal
                // +' (S/.'+ total +' total)'
            );
      }
  });
}

function getAllGrifos(fecha) {
  return $.ajax({
    type: 'GET',
    url: `./grifos/all/${fecha}`,
    dataType: 'json',
  });
}

function getIngresoByGrifo(idGrifo = '') {
  return $.ajax({
    type: 'GET',
    url: `./ingreso_grifos/grifo/${idGrifo}`,
    dataType: 'json',
  });
}


