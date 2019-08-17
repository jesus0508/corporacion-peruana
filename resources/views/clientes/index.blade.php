@extends('layouts.main')

@section('title','Clientes')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Clientes</a></li>
  <li><a href="#">Gestion</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('clientes.create')
  @include('clientes.table')
  <!--modales-->
  @include('clientes.show')
  @include('clientes.edit')
  <!--/.end-modales-->
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/clientes/cliente.js') }}"></script>    
@endsection