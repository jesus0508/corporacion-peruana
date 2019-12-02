@extends('layouts.main')
@section('title','Movimientos Grifos')
@section('styles')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Grifos</a></li>
  <li><a href="#">Movimentos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('factura_grifos.movimientos.table')
</section>
  @include('factura_grifos.movimientos.create')
  
@endsection

@section('scripts')
<script>
	$(document).ready(function () {

  let $tabla_movimiento_grifos = $('#tabla-movimiento-grifos');
  let $fecha_operacion = $('#fecha_operacion');
  $tabla_movimiento_grifos.DataTable({
    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
    },
    columnDefs: [
      {
       // searchable: false,
        targets: [-1]
      },
    ]
  });
  $fecha_operacion.datepicker();
   validateDates();
});



  function validateDates() {

  let $tabla_movimiento_grifos = $('#tabla-movimiento-grifos');

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
      var $sInicio = $('#fecha_inicio');
      var $sFin = $('#fecha_fin');
      var inicio = $.datepicker.parseDate('d/m/yy', $sInicio.val());
      var fin = $.datepicker.parseDate('d/m/yy', $sFin.val());
      var dia = $.datepicker.parseDate('d/m/yy', data[1]);
      if (!inicio || !dia || fin >= dia && inicio <= dia) {
        return true;
      }
      return false;
    }
  );

  $('#filtrar-fecha').on('click', function () {
    $tabla_movimiento_grifos.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $('#fecha_fin').val("");
    $tabla_movimiento_grifos.DataTable().draw();
  });
}

</script>
@endsection