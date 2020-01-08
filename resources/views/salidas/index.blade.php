@extends('layouts.main')
@section('title','Egresos')
@section('styles')
<link rel="stylesheet" href="{{asset('dist/css/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Egresos</a></li>
  <li><a href="#">Registro</a></li>
</ol>
@endsection

@section('content')
<section class="content">
   @include('salidas.top_button')
  <form  action="{{route('salidas.store')}}" method="POST">
    @csrf
    @include('salidas.header')
    @include('salidas.create')
  </form>  	
  @include('salidas.table')
	<!-- modales -->
  @include('salidas.modal_categoria')
  <!-- fin modales -->
</section>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/select2/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
  // $("#categoria_egreso_id").prop("selectedIndex", -1);  

  // $("#categoria_egreso_id").select2({
  //   placeholder: "Seleccione la categoria",
  //   allowClear:true
  // });
  // $("#cuenta_id").prop("selectedIndex", -1);
  // $("#cuenta_id").select2({
  //   placeholder: "Seleccione la cuenta",
  //   allowClear:true
  // });

  $('#fecha_reporte').datepicker();
  $('#fecha_egreso').datepicker();
  $('#tabla-egresos').DataTable({
    'scrollX': true,
    'responsive': false
  });
});


function validateDates() {
    let $tabla_reporte_salidas = $('#tabla-egresos');
    $('#fecha_inicio').datepicker({
      numberOfMonths: 1,
      onSelect: function (selected) {
        $('#fecha_fin').datepicker('option', 'minDate', selected)
      }
  });

  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $('#fecha_inicio').val();
      var sFin = $('#fecha_inicio').val();
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
    $tabla_reporte_salidas.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $('#fecha_fin').val("");
    $tabla_reporte_salidas.DataTable().draw();
  });
}

$(document).ready(function() {
  validateDates();
});
</script>
@endsection