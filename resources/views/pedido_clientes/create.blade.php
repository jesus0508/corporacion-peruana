@extends('layouts.main')

@section('title','Clientes')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Pedidos</a></li>
  <li><a href="#">Registro Pedidos</a></li>
</ol>
@endsection

@section('content')
<section class="content-header">
  {{-- <button class="btn btn-info pull-right">Limpiar</button> --}}
  <h1>REGISTRO PEDIDOS CLIENTES</h1>
  <form action="{{route('pedido_clientes.store')}}" method="post">
    @csrf
    <div class="row">
      <!-- left column -->
      <div class="col-md-8">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Datos Cliente</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('cliente_id') has-error @enderror">
                  <label for="cliente">Cliente</label>
                  <select class="form-control" id="cliente" name="cliente_id">
                    @foreach ( $clientes as $cliente)
                      <option value="{{$cliente->id}}">{{$cliente->razon_social}}</option>
                    @endforeach
                  </select>
                </div>
              </div><!-- end razon -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="ruc">RUC</label>
                  <input id="ruc" type="text" class="form-control" 
                          name="ruc" disabled>
                </div>
              </div><!-- end ruc -->
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box datos cliente -->

        <div id="datos-pedido" class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Datos Pedido</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('nro_pedido') has-error @enderror">
                  <label for="nro_pedido">Número de Pedido</label>
                  <input id="nro_pedido" type="text" class="form-control" 
                          name="nro_pedido" placeholder="Ingrese el numero de pedido">
                  @error('nro_pedido')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div><!-- /.numero-pedido -->
              <div class="col-md-6">
                <div class="form-group @error('grifo') has-error @enderror">
                  <label for="grifo">Grifo</label>
                  <input id="grifo" type="text" class="form-control" 
                          name="grifo" placeholder="Ingrese el nombre del Grifo">
                  @error('grifo')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div><!-- /.grifo -->
            </div><!-- /.first-row -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('fecha_descarga') has-error @enderror">
                  <label for="fecha_descarga">Fecha para descarga</label>
                  <input autocomplete="off" id="fecha_descarga" type="text" class="tuiker form-control"
                  name="fecha_descarga" placeholder="Ingrese la fecha de descarga">
                  @error('fecha_descarga')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group @error('horario_descarga') has-error @enderror">
                  <label for="horario_descarga">Horario para descarga</label>
                  <input id="horario_descarga" type="text" class="form-control"
                          name="horario_descarga" placeholder="Ingrese el horario para descarga">
                  @error('horario_descarga')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
            </div><!-- /.second-row -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group @error('observacion') has-error @enderror">
                  <label for="observacion">Observacion</label>
                  <textarea id="observacion" type="text" class="form-control"
                          name="observacion" placeholder="Ingrese alguna observacion imporante"></textarea>
                  @error('observacion')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
            </div><!-- /.third-row -->
          </div><!-- /.box-body -->
        </div><!-- /.box datos pedido -->

        <div id="datos-producto" class="box">
          <div class="box-header with-border">
            <h3 class="box-title"> DIESEL B5 (S50) UV</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div id="producto" class="row">
              <div class="col-md-6">
                <div class="form-group @error('galones') has-error @enderror">
                  <label for="galones">Galones</label>
                  <input id="galones" type="number" class="form-control" 
                          name="galones" placeholder="Ingrese el numero galones">
                  @error('grifo')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group @error('precio_galon') has-error @enderror">
                  <label for="precio_galon">Precio x Galones</label>
                  <input id="precio_galon" type="number" class="form-control" 
                          name="precio_galon" placeholder="Ingrese el precio por galon">
                  @error('grifo')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box producto-->
      </div><!--/.col (left) -->

      <div class="col-md-4">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Detalles Pedido</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-lg-4">
                <label for="fecha_pedido">Fecha de Pedido</label>
              </div>
              <div class="col-lg-8">
                <div class="form-group">
                  <input id="fecha_pedido" type="text" class="form-control" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <label for="total">Monto Total</label>
              </div>
              <div class="col-lg-8">
                <div class="form-group">
                  <input id="total" type="text" class="form-control" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 top-button">
                <button type="submit" class="btn btn-lg btn-primary">
                  <i class="fa fa-plus-square-o"> </i>
                  Registrar pedido
                </button>
              </div>
            </div>
          </div>
        </div>
      </div> <!--/.col (right) -->
    </div> <!-- /.row-top -->

  </form>  
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/pedido_cliente.js') }}"></script> 
@endsection