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
  <h2>FACTURA PEDIDOS PROVEEDORES</h2>

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
                  <select class="form-control" id="nro_pedido" name="nro_pedido" readonly>
                      <option selected="true" value="{{$pedido->id}}">{{$pedido->nro_pedido}}</option>

                  </select>
                </div>
              </div><!-- end razon -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="scop">SCOP pedido</label>
                  <input id="scop" type="text" class="form-control" 
                          name="scop" value="{{$pedido->scop}}" readonly>
                </div>
              </div><!-- end ruc -->
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box datos pedido -->

      @includeWhen($pedido->hasntFactura(), 'facturas.Ind.form_factura')

      </form>
    <!-- -->
   

      </div><!--/.col (left) -->

      @include('facturas.Ind.detalles_pedido')<!--/.col (right) -->
    </div> <!-- /.row-top -->

 
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>


<script>
   $("#monto_factura").on('change',function(){
    var monto=$("#monto_factura").val();
    var total=$("#total").val();

    if(monto>0 && total>0){
      var diferencia = total-monto;
     // Math.round(diferencia*100)/100;
      diferencia = parseFloat(diferencia).toFixed(2);
      
      
      if( diferencia < 0 ){
        var dif = document.getElementById('diferencia');
          dif.style.backgroundColor = "#e53935";
          dif.style.color = "black";
       }else{
          var dif = document.getElementById('diferencia');
          dif.style.backgroundColor = "#4caf50";
          dif.style.color = "black";

       }


      $('#diferencia').val(diferencia);
    

    }else{
      var dif = document.getElementById('diferencia');
      dif.style.backgroundColor = "#eee";
      dif.style.color = "#555";
      $('#diferencia').val(''); 
      




    }

  });


$(document).ready(function() { 

  $("#placa").prop("selectedIndex", -1);

  $("#placa").select2({
    placeholder: "Seleccione la placa",
    allowClear:true
  });

  $("#placa").on('change',function(){
    var id=$("#placa").val();

    if(id){//id del proveedor

      findByPlaca(id);

    }else{
      $('#nombre_transportista').val('');
      $('#modelo').val('');
      $('#marca').val('');
    }

  });

});

function findByPlaca(id){
  $.ajax({
    type: 'GET',
    url:`../../transportista/${id}`,
    success: (data)=>{
      console.log(data);
      $('#nombre_transportista').val(data.transportista.nombre_transportista);
      $('#modelo').val(data.modelo);
      $('#marca').val(data.marca);

    }
  });
}


</script>

@endsection