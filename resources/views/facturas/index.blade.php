@extends('layouts.main')

@section('title','Facturas')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Facturas</a></li>
  <li><a href="#">Pedidos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <h3 class="pull-left">FACTURA de PEDIDO a PROVEEDOR</h3>
      <div class="pull-right">
        <a href="{{route('pedidos.index')}}">
          <button class="btn bg-olive">
          IR PEDIDOS &nbsp; <span class="fa fa-list"></span>
          </button>
        </a>
        <a href="{{route('factura_proveedor.create')}}">
          <button class="btn bg-purple">
        Registrar otra Factura &nbsp;   <i class="fa fa-share-square-o"></i>
          </button>
        </a>
      </div>
    </div>    
  </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/factura.js') }}"></script>
@endsection