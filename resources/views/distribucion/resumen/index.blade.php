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
  @include('distribucion.resumen.tabla_pedido_cliente') 
</section>
@endsection
@section('scripts')
<script>

$(document).ready(function() {
  $('#tabla-pedido_clientes_resaeaada').DataTable({
	
    "ordering": false,
    'language': {
             'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        }
  });
} );
</script>
@endsection
