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
  <form action="{{route('pedido_clientes.store')}}" method="post">
    @csrf
    <div class="row">
      <!-- left column -->
      <div class="col-md-8">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Datos Pedido Proveedor</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nro_pedido">Pedido</label>
                  <select class="form-control" id="nro_pedido" name="nro_pedido">
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
                          name="scop" disabled>
                </div>
              </div><!-- end ruc -->
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box datos cliente -->

        <div id="datos-pedido" class="box box-success">
          <div class="box-header with-border">
            <div class="row">
                <div class="col-md-4">
                   <h3 class="box-title"> Datos Factura Proveedor</h3>
                </div>
                <div class="col-md-4 pull-right">
                  <button class="btn  btn-success"> 
                    <i class="fa fa-plus-circle">&nbsp;</i>
                     ASIGNAR FACTURA</button>
                </div>
              </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="nro_factura">Número de Factura</label>
                  <input id="nro_factura" type="text" class="form-control" 
                          name="nro_factura" placeholder="Ingrese el numero de pedido">
                </div>
              </div><!-- /.numero-pedido -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="monto_factura">Monto total - Factura</label>
                  <input id="monto_factura" type="text" class="form-control" 
                          name="monto_factura" placeholder="Ingrese la fecha de la factura">
                </div>
              </div><!-- /.grifo -->
            </div><!-- /.first-row -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fecha_descarga">Fecha factura</label>
                  <input autocomplete="off" id="fecha_descarga" type="text" class="tuiker form-control"
                  name="fecha_descarga" placeholder="Ingrese la fecha de la factura">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="horario_descarga">Hora descarga - Factura</label>
                  <input id="horario_descarga" type="text" class="form-control"
                          name="horario_descarga" placeholder="Ingrese el horario">
                </div>
              </div>
            </div><!-- /.second-row -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="observacion">Observacion</label>
                  <textarea id="observacion" type="text" class="form-control"
                          name="observacion" placeholder="Ingrese alguna observacion importante"></textarea>
                </div>
              </div>
            </div><!-- /.third-row -->
          </div><!-- /.box-body -->
        </div><!-- /.box datos pedido -->

        <div id="datos-producto" class="box box-success">
          <div class="box-header with-border">
              <div class="row">
                <div class="col-md-4">
                   <h3 class="box-title"> Datos Transportista</h3>
                </div>
                <div class="col-md-4 pull-right">
                  <button class="btn  btn-success"> 
                    <i class="fa fa-plus-circle">&nbsp;</i>
                     ASIGNAR TRANSPORTISTA</button>
                </div>
              </div>
           

          </div><!-- /.box-header -->
          <div class="box-body">
            <div id="" class="row">
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="placa">Placa*</label>
                  <input id="placa" type="text" class="form-control" 
                          name="placa" placeholder="Ingrese el numero de placa">
                  
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="transportista">Transportista</label>
                  <input id="transportista" type="text" class="form-control" 
                          name="transportista" placeholder="" disabled>
                </div>
              </div>
            </div>

            <div id="" class="row">
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="modelo">Modelo cisterna</label>
                  <input id="modelo" type="text" class="form-control" 
                          name="modelo" placeholder="Ingrese el modelo de la cisterna">
                  
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="marca">Marca</label>
                  <input id="marca" type="text" class="form-control" 
                          name="marca" placeholder="Ingrese la marca de la cisterna" >
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
              <div class="col-lg-6">
                <label for="fecha_pedido">Fecha de Pedido</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="fecha_pedido" type="date" class="form-control" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label for="planta_AR">Planta</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="planta_AR" type="text" class="form-control" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label for="costo_galon">Precio Unidad</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="costo_galon" type="text" class="form-control" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label for="galones">Cantidad de Galones</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="galones" type="text" class="form-control" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label for="total">Monto Total</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="total" type="text" class="form-control" disabled>
                </div>
              </div>
            </div>
               <div class="row">
              <div class="col-lg-6">
                <label for="diferencia">Diferencia</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="diferencia" type="text" class="form-control" disabled>
                </div>
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
<script src="{{ asset('js/factura.js') }}"></script> 
<script>
$(document).ready(function() { 

  $("#nro_pedido").prop("selectedIndex", -1);

  $("#nro_pedido").select2({
    placeholder: "Ingresa el número de pedido",
    allowClear:true
  });

  $("#nro_pedido").on('change',function(){
    var id=$("#nro_pedido").val();

    if(id){//id del proveedor

      findByNroPedido(id);

    }else{
      $('#scop').val('');
      $('#costo_galon').val('');
      $('#galones').val('');
      $('#total').val('');
      $('#planta_AR').val('');
    }

  });

});

function findByNroPedido(id){
  $.ajax({
    type: 'GET',
    url:`../factura_proveedor/${id}`,
    success: (data)=>{
      console.log(data);
      $('#scop').val(data.scop);
      $('#costo_galon').val(data.costo_galon);
      $('#galones').val(data.galones);
      $('#total').val(data.galones*data.costo_galon);
      $('#planta_AR').val(data.planta);
    }
  });
}</script>
@endsection