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
  <li><a href="#">Pedidos Distribucion</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('distribucion.grifos.pedido_proveedor')
  <br>
  <div class="row">
    <div class="col-md-12">
       <a class="btn btn-primary" href="{{route('pedidos.distribuir', $pedido->id)}}"><span class="fa fa-arrow-left">&nbsp;</span>Atrás</a>
    </div>   
  </div>
  <br>
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
function goBack() {
  window.history.back();
}
</script>
@endsection

