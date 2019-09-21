@extends('layouts.main')

@section('title','Gastos')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
    .ui-datepicker-calendar {
        display: none;
    }
    </style>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Gastos</a></li>
  <li><a href="#">Reporte Mensual</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('reportes.mensual.filtrado')
  @include('reportes.mensual.table')

  <!--/.end-modales-->
</section>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
$(document).ready(function() {
  $('#tabla-gastos-mensual').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "responsive": true,

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                'S/. '+pageTotal
                // +' (S/.'+ total +' total)'
            );
      }
  });
});

var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

function ayerFecha(){
 	let f=new Date();
	f.setMonth(f.getMonth() - 1); 
	
    return meses[f.getMonth()] +" " + f.getFullYear();
}
function hoyFecha(){
	let f=new Date();
    return meses[f.getMonth()] +" " + f.getFullYear();
}

function validateDates() {
  let $tabla_pagos_lista = $('#tabla-gastos-mensual');
 
  $('#fecha_inicio').datepicker({
        changeMonth: true,
      	changeYear: true,
      	showButtonPanel: true,
       	dateFormat: 'MM yy',
      	onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
  });
  $('#fecha_fin').datepicker({
    numberOfMonths: 1,
    onSelect: function (selected) {
      $('#fecha_inicio').datepicker('option', 'maxDate', selected)
    }
  });
  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $('#fecha_inicio').val();
      var sFin = $('#fecha_inicio').val();
      let cell = data[2];
      if (sInicio) {
        return sInicio === cell;
      }
      return true;
    }
  );

  $('#filtrar-fecha').on('click', function () {
    $tabla_pagos_lista.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $('#fecha_fin').val("");
    $tabla_pagos_lista.DataTable().draw();
  });
  $('#today-fecha').on('click', function () {
    let hoy = hoyFecha();
    console.log(hoy);
    $('#fecha_inicio').val(hoy);
    $('#fecha_fin').val(hoy);
    $tabla_pagos_lista.DataTable().draw();
  });
  $('#yesterday-fecha').on('click', function () {
   let ayer = ayerFecha();
    console.log(ayer);
    $('#fecha_inicio').val(ayer);
    $('#fecha_fin').val(ayer);
    $tabla_pagos_lista.DataTable().draw();
  });
}

$(document).ready(function() {
    validateDates();
    let $filter_proveedor = $('#filter-grifo');
    let $tabla_pedido_proveedores = $('#tabla-gastos-diarios');
  	$filter_proveedor.on('change', function () {
    $tabla_pedido_proveedores.DataTable().draw();
  });
} );
</script>
 
@endsection