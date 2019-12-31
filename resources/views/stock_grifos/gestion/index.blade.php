@extends('layouts.main')

@section('title','Transporte')

@section('styles')
  @include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Transporte</a></li>
  <li><a href="#">Registro Ingreso</a></li>
</ol>
@endsection


@section('content')
<section class="content">
  @include('stock_grifos.gestion.table')
 {{-- @include('transporte.egresos.table') --}} 
  
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {

	  $('#tabla-stock-grifos').DataTable({
      "responsive": false, 
      "scrollX": true,
    });
});
</script>
@endsection
