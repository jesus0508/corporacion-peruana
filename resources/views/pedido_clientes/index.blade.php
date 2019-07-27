@extends('layouts.main')

@section('title','Clientes')

@section('styles')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="#">Ver Pedidos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  <div class="content-header">
    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-5">
            <div class="form-inline">
              <label for="fecha_inicio">Desde: </label>
              <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control"
                name="fecha_inicio" placeholder="Desde">
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-inline">
              <label for="fecha_fin">Hasta: </label>
              <input autocomplete="off" id="fecha_fin" type="text" class="tuiker form-control"
                name="fecha_fin" placeholder="Final">
            </div>
          </div>
          <div class="col-md-2">
            <button id="filtrar" class="btn btn-info">Filtrar</button>
          </div>
        </div>

      </div>
      <div class="col-md-6 opciones">
        <a href="{{route('pedido_clientes.create')}}" class="btn btn-primary">
          <i class="fa fa-plus-square-o"> </i>
          Nuevo pedido
        </a>
        <a href="{{route('pedido_clientes.create')}}" class="btn btn-default">
          <i class="fa  fa-file-excel-o"> </i>
          Exportar a Excel
        </a>
      </div>
    </div>
  </div>
  <h2>LISTA DE PEDIDOS</h2>
  @include('pedido_clientes.table')
  @include('pedido_clientes.confirmar_pedido')
  @include('pedido_clientes.show')
  @include('pedido_clientes.edit') 
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/pedido_cliente.js') }}"></script> 
@endsection