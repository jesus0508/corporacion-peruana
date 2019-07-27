@extends('layouts.main')

@section('title','Clientes')

@section('styles')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Pedidos</a></li>
  <li><a href="#">Ver Pedidos</a></li>
</ol>
@endsection

@section('content')
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