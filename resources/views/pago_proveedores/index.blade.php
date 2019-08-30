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
  @include('pago_proveedores.create')
  @include('pago_proveedores.table')
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/pedidos.js') }}"></script>

@endsection