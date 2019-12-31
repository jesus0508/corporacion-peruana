@extends('layouts.main')
@section('title','Ingresos')
@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Grifos</a></li>
  <li><a href="#">Ingresos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('ingreso_grifos.table')
  @include('ingreso_grifos.create')
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
	$(document).ready(function () {
  let $select_grifo = $('#seletc-grifos');
  let $tabla_ingreso_grifos = $('#tabla-ingreso_grifos');
  let $modal_create_ingreso = $('#modal-create-ingreso');
  let $fecha_ingreso = $('#fecha_ingreso');
  let $fecha_reporte = $('#fecha_reporte');    
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

  $fecha_ingreso.datepicker();
  $fecha_reporte.datepicker();

  validateDates();

  $('#filtrar-fecha').on('click', function () {
    $tabla_ingreso_grifos.DataTable().draw();
  });

  $modal_create_ingreso.on('show.bs.modal', function (event) {
    hoy = $.datepicker.formatDate('yy-m-d', new Date());
    fillSelectGrifos(hoy);
  });

  $fecha_reporte.on('change', function (event) {
    fecha_reporte = $fecha_reporte.val();
    fecha_reporte = convertDateFormat(fecha_reporte);
    fillSelectGrifos(fecha_reporte);
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
    //let calibracion = parseFloat($calibracion.val());
    let precio_galon = $precio_galon.val();
    precio_galon = (precio_galon)?parseFloat(precio_galon):0.00;
		//let totalGalones = venta;
   	let precioTotal = (venta * precio_galon).toFixed(2);
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

  function convertDateFormat(string) {
        var info = string.split('/').reverse().join('-');
        return info;
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
      var dia = $.datepicker.parseDate('d/m/yy', data[2]);//filtro x fecha ingreso
      if (!inicio || !dia || fin >= dia && inicio <= dia) {
        return true;
      }
      return false;
    }
  );
  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $('#fecha_fin').val("");
    $tabla_pagos_lista.DataTable().draw();    
  });

});

function inicializarSelect2($select, text, data) {
  $select.select2({
    placeholder: text,
    allowClear: true,
    data: data
  });
  //$select.prop('selectedIndex', -1);
}

function inicializarDataTable($table) {
  $table.DataTable({
    "dom": 'Blfrtip',
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
              $('c[r=G'+nRows+'] t', sheet).text('TOTAL:' );
              $('c[r=G'+nRows+'] t', sheet).attr('s','37');
              $('c[r=H'+nRows+'] t', sheet).text( total );
              $('c[r=H'+nRows+'] t', sheet).attr('s','37');             
            },
        'exportOptions':
        {
          columns:[1,2,3,4,5,6,7,8]
        },
        footer: true
      }], 

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Total over this page
            pageTotal = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);
            // Update footer
            $( api.column( 8 ).footer() ).html(
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
</script>
@endsection