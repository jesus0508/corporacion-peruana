@extends('layouts.main')

@section('title','Venta Facturada')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Grifos</a></li>
  <li><a href="#">Cancelaciones</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include( 'cancelaciones.header' )
  @include('cancelaciones.create') 
  @include('cancelaciones.table')
  
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
	
$('#fecha').datepicker({
   // minDate: 0,
  });
$('#fecha_deposito').datepicker({
   // minDate: 0,
  });
$(document).ready(function() { 

  $("#grifo_id").prop("selectedIndex", -1);

  $("#grifo_id").select2({
    placeholder: "Ingresa el grifo",
    allowClear:true
  });

  $("#grifo_id").on('change',function(){
    let id=$("#grifo_id").val();
    let fecha = $("#fecha").val();
    fecha = convertDateFormat(fecha);

    if(id && fecha){//id del proveedor

      findByIdFecha(id,fecha);

    }else{
      $('#nro_serie').val('');
      $('#facturacion').val('');
      $('#galones').val('');
      $('#precio_galon').val('');
      $('#monto_ingreso').val('');
      $('#saldo').val('');
      $('#ingreso_grifo_id').val('');     
    }

  });
  $("#fecha").on('change',function(){
    let id=$("#grifo_id").val();
    let fecha = $("#fecha").val();
    fecha = convertDateFormat(fecha);

    if(id && fecha){//id del proveedor

      findByIdFecha(id,fecha);

    }else{
      $('#nro_serie').val('');
      $('#facturacion').val('');
      $('#galones').val('');
      $('#precio_galon').val('');
      $('#monto_ingreso').val('');
      $('#saldo').val('');
      $('#ingreso_grifo_id').val('');     
    }

  });
});




function convertDateFormat(string) {
        var info = string.split('/').reverse().join('-');
        return info;
}

function findByIdFecha(id,fecha){
  $.ajax({
    type: 'GET',
    url:`../cancelacion_search/${id}/${fecha}`,
    success: (data)=>{
      console.log(data);
      if (data) {
 			$('#nro_serie').val('Boletas serie X, serie Y..');
      $('#facturacion').val('...');
      let galones = Number(data.lectura_final) - Number(data.lectura_inicial);
      $('#galones').val(galones);
      $('#precio_galon').val(data.precio_galon);
      $('#monto_ingreso').val(data.monto_ingreso);
      $('#saldo').val('saldo..');  
      $('#ingreso_grifo_id').val(data.id);
      let pagado = 0;
      data.cancelaciones.forEach(function(element) {
			  pagado = Number(pagado) + Number(element.monto);
			});
			let saldo = data.monto_ingreso - pagado;
			$('#saldo').val(saldo);  
      }else{
				toastr.warning('Datos Ingreso Grifo no encontrados!', 'Warning Alert', { timeOut: 3000 });
        $('#nro_serie').val('');
	      $('#facturacion').val('');
	      $('#galones').val('');
	      $('#precio_galon').val('');
	      $('#monto_ingreso').val('');
	      $('#saldo').val(''); 
	      $('#ingreso_grifo_id').val('');
      }
     

    },
      error: (error) => {
        toastr.error('Ocurrio un Error!', 'Error Alert', { timeOut: 2000 });
        $('#nro_serie').val('');
	      $('#facturacion').val('');
	      $('#galones').val('');
	      $('#precio_galon').val('');
	      $('#monto_ingreso').val('');
	      $('#saldo').val('');
	      $('#ingreso_grifo_id').val('');  
      }
  });
}

</script>
@endsection