@extends('layouts.main')
@section('title','Ingresos')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ingresos</a></li>
  <li><a href="#">Registro</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('ingresos_otros.header')
  @include('ingresos_otros.create')
	<!-- modales -->
   @include('ingresos_otros.modal_categoria')
   <!-- fin modales -->
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
	
</script>
@endsection