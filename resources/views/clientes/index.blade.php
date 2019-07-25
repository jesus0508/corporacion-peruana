@extends('layouts.main')
@section('title','Clientes')
@section('content')
<section class="content-header">
  <h1>GESTIÓN CLIENTES</h1>
</section>
<section class="content">
  @include('clientes.create')
  <h2>LISTA DE CLIENTES</h2>
  @include('clientes.table')
  <!--modales-->
  @include('clientes.show')
  @include('clientes.edit')
  <!--/.end-modales-->
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/cliente.js') }}"></script>    
@endsection