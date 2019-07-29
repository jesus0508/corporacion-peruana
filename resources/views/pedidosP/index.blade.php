@extends('layouts.main')

@section('title','Proveedores')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('content')
<section class="content-header">
  <h1>
    GESTIÓN PEDIDOS PROVEEDORES
    <small>Optional description</small>
  </h1>
  @include('pedidosP.create')
</section>

  @include('pedidosP.table')

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/pedido.js') }}"></script> 
<script>
$(document).ready(function() { 

  $("#planta").prop("selectedIndex", -1);

  $("#planta").select2({
    placeholder: "Ingresa la planta",
    allowClear:true
  });

  $("#planta").on('change',function(){
    var id=$("#planta").val();

    if(id){//id del proveedor

      findByPlanta(id);

    }else{
      $('#proveedor').val('');
    }

  });

});

function findByPlanta(id){
  $.ajax({
    type: 'GET',
    url:`proveedores/${id}`,
    success: (data)=>{
      console.log(data);
      $('#proveedor').val(data.razon_social);
    }
  });
}</script>
@endsection