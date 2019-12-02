@extends('layouts.main')

@section('title','Ingresos y Egresos')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ingresos</a></li>
  <li><a href="#">Egresos</a></li>
  <li><a href="#">Depositos</a></li>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
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
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "responsive": true,
      "searching":true    
  });
  
});
</script>
@endsection