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
  @include('partials.session-status')
</section>
@endsection