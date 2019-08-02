@extends('layouts.main')

@section('title','Clientes')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('content')
<section class="content">
  {{-- <button class="btn btn-info pull-right">Limpiar</button> --}}
  <h2>CONFIRMACION PEDIDOS PROVEEDORES</h2>

    <div class="row">
      <!-- left column -->
      
      <div class="col-md-8">
      <form action="{{route('factura_proveedor.store')}}" method="post">
        @csrf

        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Datos Pedido Proveedor</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nro_pedido">Pedido</label>
                  <select class="form-control" id="nro_pedido" name="nro_pedido" required>
                    @foreach ( $pedidos as $pedido)
                      <option value="{{$pedido->id}}">{{$pedido->nro_pedido}}</option>
                    @endforeach
                  </select>
                </div>
              </div><!-- end razon -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="scop">SCOP pedido</label>
                  <input id="scop" type="text" class="form-control" 
                          name="scop" readonly>
                </div>
              </div><!-- end ruc -->
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box datos pedido -->
        @include('facturas.form_factura')
      </form>
      @include('facturas.form_transportista')

      </div><!--/.col (left) -->

      @include('facturas.detalles_pedido')<!--/.col (right) -->
    </div> <!-- /.row-top -->

 
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/factura.js') }}"></script>

@endsection