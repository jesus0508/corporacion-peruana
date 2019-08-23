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
  <h2>RESUMEN PEDIDO PROVEEDORES</h2>

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
                  <select class="form-control" id="nro_pedido" name="nro_pedido" disabled>
                      <option selected="true" value="{{$pedido->id}}">{{$pedido->nro_pedido}}</option>

                  </select>
                </div>
              </div><!-- end razon -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="scop">SCOP pedido</label>
                  <input id="scop" type="text" class="form-control" 
                          name="scop" value="{{$pedido->scop}}" disabled>
                </div>
              </div><!-- end ruc -->
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box datos pedido -->

      @includeWhen($pedido->factura_id != null ,'facturas.show.form_factura')

      @include('facturas.show.form_transportista')

      </div><!--/.col (left) -->

      @include('facturas.show.detalles_pedido')<!--/.col (right) -->
    </div> <!-- /.row-top -->

 
</section>
@endsection
@section('scripts')
<script>

$(document).ready(function() {
    var monto=$("#monto_factura").val();
    var total=$("#total").val();

    if(monto>0 && total>0){
      var diferencia = monto-total;
     // Math.round(diferencia*100)/100;
      diferencia = parseFloat(diferencia).toFixed(2);
      
      
      if( diferencia > 0 ){
        var dif = document.getElementById('diferencia');
          dif.style.backgroundColor = "#e53935";
          dif.style.color = "black";
       }else{
          var dif = document.getElementById('diferencia');
          dif.style.backgroundColor = "#4caf50";
          dif.style.color = "black";

       }


      $('#diferencia').val(diferencia);
    }  

});
</script>


@endsection
