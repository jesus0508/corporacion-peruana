@extends('layouts.main')

@section('title','Transportistas')
@section('styles')

<link rel="stylesheet" href="{{asset('css/app.css')}}">

@endsection
@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Transportistas</a></li>
  <li><a href="#">Gestion</a></li>
</ol>
@endsection

@section('content')
<section class="content-header">
  <h1>GESTIÓN Vehículos transportistas</h1>
</section>
<section class="content">
  
  <h2>LISTA DE VEHICULOS DE <span style="color: blue; font-weight: 400;">{{$transportista->nombre_transportista}}</span></h2>
  @include('vehiculos.table')
  <!--modales-->
  @include('vehiculos.edit')
  <!--/.end-modales-->
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/vehiculo.js') }}"></script>  
@endsection