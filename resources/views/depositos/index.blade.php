@extends('layouts.main')

@section('title','Ingresos y Egresos')
@section('styles')
{{-- select2 4.0.8 --}}
<link rel="stylesheet" href="{{asset('dist/css/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ingresos && Egresos</a></li>
  <li><a href="#">Depositos</a></li>
  <li><a href="#">Crear</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('depositos.header') 
  @include('depositos.create') 
  @include('depositos.table')

</section>
@endsection
@section('scripts')
{{-- select2 4.0.8 --}}
<script src="{{ asset('dist/js/select2/select2.min.js') }}"></script>
<script>
$(document).ready(function() {    

  $("#cuenta_id").prop("selectedIndex", -1);
  $("#cuenta_id").select2({
    placeholder: "Seleccione la cuenta",
    allowClear:true
  });
  
  $('#fecha_reporte').datepicker({
   //minDate: 0,
  });

  $('#tabla-depositos').DataTable({
      "responsive": false,
      "scrollX": true,
      "searching":true    
  });
  
});
</script>
@endsection