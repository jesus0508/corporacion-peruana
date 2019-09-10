@extends('layouts.main')
@section('title','Pagos')
@section('styles')
<link rel="stylesheet" href="{{asset('css/app.css')}}">

@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Transportistas</a></li>
  <li><a href="#">Fletes</a></li>
  <li><a href="#">Pago Transportistas</a></li>
</ol>
@endsection

@section('content')

<section class="content">
	@php
  $desc = 0;
@endphp
  @foreach ($lista_descuento as $pedido_cliente)
    @php
      $desc += number_format((float)
                        $pedido_cliente->faltante * $pedido_cliente->costo_galon, 2, '.', '');
    @endphp
  @endforeach
  @include('pago_transportistas.create')
  @include('pago_transportistas.table_fletes')
  @include('pago_transportistas.table_descuento')
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="//cdn.rawgit.com/ashl1/datatables-rowsgroup/v1.0.0/dataTables.rowsGroup.js"></script> 

<script>

$(document).ready(function(){
//Inicializar monto Descuento rellenar datos(total,pendiente)
 	let monto_descuento =$('#monto_descuento').val();
  let total_faltante =$('#total_faltante').val();
  let monto_pendiente = total_faltante - monto_descuento;
  let total_pago = $('#subtotal').val() - monto_descuento;    
  total_pago = parseFloat(total_pago).toFixed(2);
  monto_pendiente =parseFloat(monto_pendiente).toFixed(2);
  if( monto_descuento >= 0 && monto_descuento<=total_faltante){
    $('#monto_pendiente').val(monto_pendiente);
    $('#descuento_calculo').val('S/. '+monto_descuento);
    $('#total_pago').val(total_pago);
	  }else{
   	$('#descuento_calculo').val('valor incorrecto');
    $('#monto_pendiente').val('');
    $('#total_pago').val('');
	}
console.log(monto_pendiente);
  //Onchange en monto Descuento rellenar datos(total,pendiente)
  $("#monto_descuento").on('change',function(){
 	  let monto_descuento =$('#monto_descuento').val();
    let total_faltante =$('#total_faltante').val();
    let monto_pendiente = total_faltante - monto_descuento;
    let total_pago = $('#subtotal').val() - monto_descuento;
    total_pago = parseFloat(total_pago).toFixed(2);
    if( monto_descuento >= 0 && monto_descuento<=total_faltante){
      $('#monto_pendiente').val(monto_pendiente);
      $('#descuento_calculo').val('S/. '+monto_descuento);
      $('#total_pago').val(total_pago);
	} else{
   	  $('#descuento_calculo').val('valor incorrecto');
      $('#monto_pendiente').val('');
      $('#total_pago').val('');
	}
 });
   

	  $('#tabla-pago-transportista').DataTable({
	   "columnDefs": [
        {"className": "dt-center", "targets": [ 3,4,5,7 ] }], 
      //"ordering": false,
      "paging": false,
      "info": false,
      'searching': false,    
      "responsive": true,
      'rowsGroup': [3,4,5,7] ,  
       // "footerCallback": function ( row, data, start, end, display ) {        
       //      total = this.api()
       //          .column(6)//numero de columna a sumar
       //          //.column(6, {page: 'current'})//para sumar solo la pagina actual
       //          .data()
       //          .reduce(function (a, b) {
       //              return parseInt(a) + parseInt(b);
       //          }, 0 );

       //      $(this.api().column(6).footer()).html(total);
            
       //  }          
            
  	});
	$('#tabla-flete-faltantes2').DataTable({
	   "columnDefs": [
        {"className": "dt-center", "targets": [ 0,1,2,3,4,5,6,7 ] }], 
      //"ordering": false,
      "paging": false,
      "info": false,
      'searching': false,    
      "responsive": true,
    //  'rowsGroup': [3,4,5,7] ,  
       // "footerCallback": function ( row, data, start, end, display ) {        
       //      total = this.api()
       //          .column(6)//numero de columna a sumar
       //          //.column(6, {page: 'current'})//para sumar solo la pagina actual
       //          .data()
       //          .reduce(function (a, b) {
       //              return parseInt(a) + parseInt(b);
       //          }, 0 );

       //      $(this.api().column(6).footer()).html(total);
            
       //  }          
            
  	});
});		  
</script>
@endsection