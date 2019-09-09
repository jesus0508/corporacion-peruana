@extends('layouts.main')

@section('title','Venta')
@section('styles')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="#">Pedidos Distribucion</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include( 'distribucion.resumen.buttons_top')
  @include('distribucion.resumen.pedido_proveedor')
  @include('distribucion.resumen.tabla_pedido_cliente') 
  @includeWhen(isset($pedidos_grifos),'distribucion.resumen.tabla_pedido_grifo')
</section>
@endsection


