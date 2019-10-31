@extends('layouts.main')

@section('title','Transporte')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Transporte</a></li>
  <li><a href="#">Registro</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('nelida.salidas.create')
  @include('nelida.table')
  
  <!--modales-->
  
  <!--/.end-modales-->
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/clientes/cliente.js') }}"></script>    
@endsection