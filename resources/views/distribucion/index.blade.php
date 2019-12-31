@extends('layouts.main')

@section('title','Venta')
@section('styles')
<link rel="stylesheet" href="{{asset('dist/css/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="#">Pedido Distribucion</a></li>
  <li><a href="#"> Distribucion A PEDIDOS Clientes</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('distribucion.buttons_top')
  @include('distribucion.pedido_proveedor')
  @includeWhen($pedido->vehiculo_id == null ,'distribucion.pedido_transportista')
  @includeWhen( $pedido->vehiculo_id != null ,'distribucion.pedido_transportista_show')
  @include('distribucion.tabla_pedido_cliente') 
</section>
@endsection
@section('scripts')
<script src="{{ asset('dist/js/select2/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
  $('#tabla-pedido_clientes_dist').DataTable({
  "ordering": false
  });
} );

$(document).ready(function() { 

  $("#placa").prop("selectedIndex", -1);

  $("#placa").select2({
    width: '100%',
    placeholder: "Seleccione la placa",
    allowClear:true
  });

  $("#placa").on('change',function(){
    var id=$("#placa").val();

    if(id){//id del vehiculo

      findByPlaca(id);

    }else{
      document.getElementById('nombre_transportista').innerHTML = '';
      $('#detalle_compartimiento').val('');
      $('#capacidad').val('');
    }

  });

});

function findByPlaca(id){
  $.ajax({
    type: 'GET',
    url:`../showVehiTrans/${id}`,
    success: (data)=>{
      console.log(data);
      document.getElementById('nombre_transportista').innerHTML 
                      = data.transportista.nombre_transportista;
     // $('#nombre_transportista').val(data.transportista.nombre_transportista);
      $('#detalle_compartimiento').val(data.detalle_compartimiento);
      $('#capacidad').val(data.capacidad);

    }
  });
}
</script>
@endsection

