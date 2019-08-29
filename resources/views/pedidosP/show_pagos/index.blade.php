@extends('layouts.main')

@section('title','Proveedores')

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/pedidos.js') }}"></script> 


@endsection