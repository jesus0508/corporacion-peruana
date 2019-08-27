@extends('layouts.main')

@section('title','Distribucion')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
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

