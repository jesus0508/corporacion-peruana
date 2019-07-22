@extends('layouts.main')

@section('title','Clientes')

@section('content')
<section class="content-header">
  <h1>GESTIÓN PEDIDOS CLIENTES</h1>
  @include('pedido_clientes.create')
</section>

<section class="content">
  <h2>LISTA DE PEDIDOS</h2>
  @include('pedido_clientes.table')
  @include('pedido_clientes.show')
  @include('pedido_clientes.edit')
  @include('partials.session-status')  
</section>
@endsection