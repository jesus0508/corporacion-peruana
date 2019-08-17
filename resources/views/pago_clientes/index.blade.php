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
  @include('pago_clientes.table')
</section>
@endsection

@section('scripts')

<script src="{{ asset('js/pagoClientes/pagos.js') }}"></script>
@endsection