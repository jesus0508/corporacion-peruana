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

      @include('facturas.Ind.datos_pedido_proveedor')

      @includeWhen($pedido->factura_proveedor_id != null ,'facturas.show.form_factura')

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
