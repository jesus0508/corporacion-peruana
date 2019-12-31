@extends('layouts.main')

@section('title','Pedidos')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{route('pedidos.index')}}">Pedidos</a></li>
  <li><a href="#">Historial Pago Pedido</a></li>
</ol>
@endsection

@section('content')

<section class="content">
    @include('pedidosP.partials.opciones_show_pagos')
	@include('pedidosP.show_pagos.detalles_pedido')
    @include('pedidosP.show_pagos.table')
</section>

@endsection

@section('scripts')
<script src="{{ asset('js/pedidos.js') }}"></script> 
@endsection