@extends('layouts.main')

@section('title','Distribucion')

@section('styles')
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="#">Pedido Distribucion</a></li>
  <li><a href="#">Distribucion a GRIFOS</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('distribucion.grifos.buttons_top')
  @include('distribucion.grifos.pedido_proveedor')
  @include('distribucion.grifos.tabla_grifos') 
</section>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
  $('#tabla-pedido_clientes_dist').DataTable({
  "ordering": false,
  responsive: false,
  scrollX: true,

  });
} );
</script>
@endsection

