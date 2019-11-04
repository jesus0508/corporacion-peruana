@extends('layouts.main')

@section('title','Venta Facturada')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{route('grifos.index')}}">Grifos</a></li>
  <li><a href="{{route('factura_grifos.create')}}">Facturacion Venta Grifo</a></li>
  <li><a href="#">Cancelaciones</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include( 'factura_grifos.cancelaciones.header' )
  @include('factura_grifos.cancelaciones.create') 
  @include('factura_grifos.cancelaciones.table')
  
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
	

$(document).ready(function() {
  $('#tabla-cancelaciones').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "responsive": true,
      "searching":true,   
      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Total over this page
            getSubtotal(api,5);
      }
  });
});

  function getSubtotal(api,column){
    pageTotal = api
                .column( column, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2); 
            // Update footer
            $( api.column( column ).footer() ).html(
                pageTotal
                // +' (S/.'+ total +' total)'
            );

  }
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
      clearInputs();
      $('#register').attr("disabled", false);
  
    }

  });
  $("#fecha").on('change',function(){
    let id=$("#grifo_id").val();
    let fecha = $("#fecha").val();
    fecha = convertDateFormat(fecha);

    if(id && fecha){//id del proveedor

      findByIdFecha(id,fecha);

    }else{
      clearInputs();    
    }

  });
});




function convertDateFormat(string) {
  var info = string.split('/').reverse().join('-');
  return info;
}

function clearInputs(){
  $('#venta_factura').val('');
  $('#venta_boleta').val('');
  $('#venta_factura').val('');
  $('#total_galones').val('');
  $('#precio_galon').val('');
  $('#monto_total').val('');
  $('#nro_serie').val('');
  $('#facturacion').val('');        
  $('#facturacion_grifo_id').val('');
  $('#saldo').val('');
  $('#register').attr("disabled", true); 
}

function findByIdFecha(id,fecha){
  $.ajax({
    type: 'GET',
    url:`../cancelacion_search/${id}/${fecha}`,
    success: (data)=>{
      console.log(data);
      if (data) {

        let venta_factura = data.venta_factura;
        let venta_boleta =  data.venta_boleta;
        //en caso no ingrese nada, se asignará 0.00
        venta_factura  = (venta_factura)? parseFloat( venta_factura ): 0.00;
        $('#venta_factura').val(venta_factura);
        venta_boleta   = (venta_boleta)? parseFloat( venta_boleta ): 0.00;
        $('#venta_boleta').val(venta_boleta);
        let total_galones = parseFloat(venta_factura+venta_boleta).toFixed(2);
        $('#total_galones').val(total_galones);
        let precio_galon = data.precio_venta;    
        precio_galon = (precio_galon)?parseFloat(precio_galon):0.00;
        $('#precio_galon').val(precio_galon);
        let monto_total = parseFloat(total_galones * precio_galon).toFixed(2);
        $('#monto_total').val(monto_total);
     		$('#nro_serie').val(data.series);
        $('#facturacion').val(data.numero_factura);       
        $('#facturacion_grifo_id').val(data.id);
          let pagado = 0;
          data.cancelaciones.forEach(function(element) {
    			  pagado = Number(pagado) + Number(element.monto);
    			});
    			let saldo = monto_total - pagado;
          saldo = (saldo)?parseFloat(saldo):0.00;
          saldo = parseFloat(saldo).toFixed(2);
    		$('#saldo').val(saldo); 
        $('#register').attr("disabled", false); 

      }else{
				toastr.warning('Datos Ingreso Grifo no encontrados!', 'Warning Alert', { timeOut: 3000 });
        clearInputs();
      }
     

    },
      error: (error) => {
        toastr.error('Ocurrio un Error!', 'Error Alert', { timeOut: 2000 });
        clearInputs(); 
      }
  });
}

</script>
@endsection