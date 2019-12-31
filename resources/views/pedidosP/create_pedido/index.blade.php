@extends('layouts.main')

@section('title','Pedidos')

@section('styles')
{{-- select2 4.0.8 --}}
<link rel="stylesheet" href="{{asset('dist/css/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{route('pedidos.index')}}">Pedidos</a></li>
  <li><a href="{{route('pedidos.create')}}">Registro</a></li>
</ol>
@endsection

@section('content')
<section class="content-header">
    <a href="{{route('pedidos.index')}}">
      <button class="btn bg-olive pull-right">
      IR PEDIDOS &nbsp; <span class="fa fa-list"></span>
      </button>
    </a>    
    <p><br></p>
</section>
<section class="content">
 @include('pedidosP.create_pedido.create')
</section>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/pedidos.js') }}"></script> 

@endsection