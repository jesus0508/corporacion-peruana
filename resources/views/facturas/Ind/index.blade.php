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
  @include( 'facturas.actions.buttons_top')
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