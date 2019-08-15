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
  @include('distribucion.pedido_proveedor')
  <div class="row">
    <div class="col-md-12">
      <button class="btn btn-lg btn-success"><i class="fa fa-plus"> </i> Distribuir Grifo(s)</button>      
    </div>    
  </div>
  </br>
  @include('distribucion.tabla_pedido_cliente') 
</section>
@endsection
@section('scripts')
<script>

$(document).ready(function() {
  $('#tabla-pedido_clientes_dist').DataTable({
  "ordering": false,
    'language': {
             'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        }
  });
} );
</script>
@endsection

