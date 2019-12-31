@extends('layouts.main')

@section('title','Pedidos')

@section('styles')
{{-- select2 4.0.8 --}}
<link rel="stylesheet" href="{{asset('dist/css/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
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
  @include('pedido_clientes.facturar_pedido')
  @include('pedido_clientes.show')
  @include('pedido_clientes.edit') 
  @include('pago_clientes.create')
  @include('pago_clientes.bloque')
</section>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/pedidoClientes/pedidoCliente.js') }}"></script> 
<script src="{{ asset('js/pagoClientes/pagos.js') }}"></script> 
@endsection