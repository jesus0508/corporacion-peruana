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
  <li><a href="#">Pedidos Distribucion</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('distribucion.pedido_proveedor')
  @include('distribucion.pedido_transportista')
  @include('distribucion.tabla_pedido_cliente') 
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
    url:`../transportista/${id}`,
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

