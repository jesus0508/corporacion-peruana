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
  <h2>RESUMEN DISTRIBUCIÓN PEDIDOS PROVEEDORES <a class="pull-right" href="{{route('pedidos.index')}}" class="btn btn-lg btn-default"> <i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Volver Pedidos Proveedores</a></h2> 
</br>
  @include('distribucion.resumen.pedido_proveedor')
  <div class="row">
    <div class="col-md-12">
      <a class="btn btn-primary" href="{{route('pedidos.distribuir', $pedido->id)}}">
      <i class="fa fa-th"> &nbsp; </i>Volver Distribución
      </a>
    </div>
  </div>
  <br>
  @include('distribucion.resumen.tabla_pedido_cliente') 
  <br>
  @includeWhen(isset($pedidos_grifos),'distribucion.resumen.tabla_pedido_grifo')
</section>
@endsection
@section('scripts')

@endsection

