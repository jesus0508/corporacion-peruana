@extends('layouts.main')
@section('title','Pagos')
@section('styles')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="#">Pagos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
<h2>RESUMEN PAGO PEDIDOS PROVEEDORES <a class="pull-right" href="{{route('pedidos.index')}}" class="btn btn-lg btn-default"> <i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Volver Pedidos Proveedores</a></h2> 
</br>
  @include('pago_proveedores.resumen.create')
  @include('pago_proveedores.resumen.table')
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/pedidos.js') }}"></script>
@endsection