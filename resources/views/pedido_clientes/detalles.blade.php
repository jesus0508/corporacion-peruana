@extends('layouts.main')

@section('title','Venta')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="{{route('pedido_clientes.index')}}">Ver Pedidos</a></li>
  <li><a href="#">Detalles Pedidos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Datos Cliente</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="cliente-detalles">Cliente</label>
                <input id="cliente-detalles" type="text" class="form-control" value="{{$pedidoCliente->cliente->razon_social}}" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="ruc-detalles">RUC</label>
                <input id="ruc-detalles" type="text" class="form-control" value="{{$pedidoCliente->cliente->ruc}}" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="numero-detalles">Numero</label>
                <input id="numero-detalles" type="text" class="form-control" value="{{$pedidoCliente->cliente->telefono}}" readonly>
              </div>
            </div>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box datos cliente -->
    </div><!--/.col (left) -->

    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">DIESEL B5 (S50) UV</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="galones-detalles">Galones</label>
                <input id="galones-detalles" type="number" class="form-control" value="{{$pedidoCliente->galones}}" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="precio_galon-detalles">Precio Galon</label>
                <input id="precio_galon-detalles" type="number" class="form-control" value="{{$pedidoCliente->precio_galon}}" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="precio_total-detalles">Total</label>
                <input id="precio_total-detalles" type="number" class="form-control" value="{{$pedidoCliente->getPrecioTotal()}}" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="saldo-detalles">Saldo</label>
                <input id="saldo-detalles" type="number" class="form-control" value="{{$pedidoCliente->saldo}}" readonly>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.box datos producto -->
    </div> <!--/.col (right) -->
    
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Datos Pedido</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="nro_factura-detalles">Número de Factura</label>
                <input id="nro_factura-detalles" type="text" class="form-control" value="{{$pedidoCliente->nro_factura}}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="fecha_pedido-detalles">Fecha de Pedido</label>
                <input id="fecha_pedido-detalles" type="text" class="form-control" value="{{$pedidoCliente->created_at}}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="fecha_descarga-detalles">Fecha para descarga</label>
                <input id="fecha_descarga-detalles" type="text" class="tuiker form-control" value="{{$pedidoCliente->fecha_descarga}}"
                name="fecha_descarga" disabled>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="horario_descarga-detalles">Horario para descarga</label>
                <input id="horario_descarga-detalles" type="text" class="form-control" value="{{$pedidoCliente->horario_descarga}}" readonly>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="observacion-detalles">Observacion</label>
                <textarea id="observacion-detalles" type="text" class="form-control" readonly>{{$pedidoCliente->observacion}}</textarea>
              </div>
            </div>
          </div><!-- /.first-row -->
        </div><!-- /.box-body -->
      </div><!-- /.box datos pedido -->
    </div>
  </div> <!-- /.row-top --> 
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Detalles Complementarios</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table id="" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>SCOP</th>
                    <th>Planta</th>
                    <th>Transportista</th>
                    <th>Placa</th>
                  </tr>
                </thead>
                  <tbody>
                  @foreach ($pedidoCliente->pedidos as $pedido)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$pedido->scop}}</td>
                      <td>{{$pedido->planta->planta}}</td>
                      @if($pedido->vehiculo_id == null )
                      <td>FLETE PROPIO</td>
                      <td>FLETE PROPIO</td>
                      @else
                      <td>{{$pedido->vehiculo->transportista->nombre_transportista}}</td>
                      <td>{{$pedido->vehiculo->placa}}</td>
                      @endif
                    </tr>
                  @endforeach
                </tbody> 
              </table>
            </div>
          </div>
        </div>
      </div><!-- /.box datos complementarios -->
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/pedidoClientes/pedidoCliente.js') }}"></script> 
@endsection