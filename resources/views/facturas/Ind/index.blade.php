@extends('layouts.main')

@section('title','Facturas Pedido Proveedor')

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
        @include('facturas.Ind.datos_pedido_proveedor')  
        @includeWhen($pedido->hasntFactura(), 'facturas.Ind.form_factura')  
      </form>
    </div><!--/.col md 8 (left) -->
      @include('facturas.Ind.detalles_pedido')<!--/.col (right) -->
  </div> <!-- /.row-top -->
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/facturaInd.js') }}"></script>

@endsection