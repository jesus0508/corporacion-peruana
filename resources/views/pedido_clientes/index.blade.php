@extends('layouts.main')

@section('title','Clientes')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection
@section('content')
<section class="content-header">
  <h1>GESTIÓN PEDIDOS CLIENTES</h1>
  @include('pedido_clientes.create')
</section>

<section class="content">
  <h2>LISTA DE PEDIDOS</h2>
  @include('pedido_clientes.table')
  @include('pedido_clientes.confirmar_pedido')
  @include('pedido_clientes.show')
  @include('pedido_clientes.edit') 
</section>
@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/pedido_cliente.js') }}"></script> 
@endsection