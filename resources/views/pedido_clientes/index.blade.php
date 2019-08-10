@extends('layouts.main')

@section('title','Pedidos')

@section('styles')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="#">Ver Pedidos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('pedido_clientes.table')
  @include('pedido_clientes.confirmar_pedido')
  @include('pedido_clientes.show')
  @include('pedido_clientes.edit') 
  @include('pago_clientes.create')
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/pedido_cliente.js') }}"></script> 
@endsection