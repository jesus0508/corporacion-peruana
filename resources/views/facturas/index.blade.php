@extends('layouts.main')

@section('title','Facturas')
@section('styles')
{{-- select2 4.0.8 --}}
<link rel="stylesheet" href="{{asset('dist/css/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Facturas</a></li>
  <li><a href="#">Pedidos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include( 'facturas.actions.buttons_top' )
  <div class="row">
      <!-- left column -->      
    <div class="col-md-8">
      <form action="{{route('factura_proveedor.store')}}" method="post">
        @csrf
        @include('facturas.datos_pedido_proveedor')
        @include('facturas.form_factura')
      </form>
    </div><!--/.col (left) -->
      @include('facturas.detalles_pedido')<!--/.col (right) -->
  </div> <!-- /.row-top -->
</section>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/factura.js') }}"></script>
@endsection