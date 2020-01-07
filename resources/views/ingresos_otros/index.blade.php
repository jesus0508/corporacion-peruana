@extends('layouts.main')
@section('title','Ingresos')
@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ingresos</a></li>
  <li><a href="#">Registro</a></li>
</ol>
@endsection

@section('content')
<section class="content">
   @include('ingresos_otros.top_button')
  <form action="{{route('ingresos_otros.store')}}" method="post">
    @csrf
    @include('ingresos_otros.header')
    @include('ingresos_otros.create')
  </form>
    @include('ingresos_otros.table')
	<!-- modales -->
   @include('ingresos_otros.modal_categoria')
   <!-- fin modales -->
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')

<script>
$(document).ready(function() {
  $("#categoria_ingreso_id").prop("selectedIndex", -1);   

  $("#categoria_ingreso_id").select2({
    placeholder: "Seleccione la categoria",
    allowClear: true
  });

  $("#banco").prop("selectedIndex", -1);
  $("#banco").select2({
    placeholder: "Seleccione el banco",
    allowClear:true
  });

 $('#fecha_reporte').datepicker();
 $('#fecha_ingreso').datepicker();
});
</script>
@endsection