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
  @include('pago_transportistas.resumen.create')
  @include('pago_transportistas.resumen.table_fletes')
  @include('pago_transportistas.resumen.table_descuento')
</section>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/datatables/dataTables.rowsGroup.js') }}"></script>
<script>


$(document).ready(function(){
  let monto_descuento =$('#monto_descuento').val();//escribes x input
  let descuento_pendiente_anterior =$('#descuento_pendiente_anterior').val();//pendiente anterior
  let total_faltante =$('#total_faltante').val();
  let monto_pendiente = total_faltante - monto_descuento;
  let total_pago = $('#subtotal').val() - monto_descuento - descuento_pendiente_anterior;    
  total_pago = parseFloat(total_pago).toFixed(2);
  monto_pendiente =parseFloat(monto_pendiente).toFixed(2);
  monto_descuento = parseFloat(monto_descuento);
  total_faltante = parseFloat(total_faltante);

  if( monto_descuento >= 0 && monto_descuento<=total_faltante){
    $('#monto_pendiente').val(monto_pendiente);
    $('#descuento_calculo').val('S/. '+monto_descuento);
    $('#total_pago').val(total_pago);
    }else{      
    $('#descuento_calculo').val('valor incorrecto');
    $('#monto_pendiente').val('');
    $('#total_pago').val('');
  }


  let table =  $('#tabla-pago-transportista').DataTable({
      "columnDefs": [
        {"className": "dt-center", "targets": [  0,1,2,3,4,5,6,7] }],
      //"ordering": false,
      "paging": false,
      "info": false,
      'searching': false,    
      "responsive": true,
      'rowsGroup': [ 3,4,5,7]        
    });
       // Handle click on "Select all" control


  $('#tabla-flete-faltantes2').DataTable({
     "columnDefs": [
        {"className": "dt-center", "targets": [ 0,1,2,3,4,5,6,7 ] }], 
      //"ordering": false,
      "paging":   false,
      "info": false,
      'searching': false,    
      "responsive": true   
            
    });
}); 
 
</script>
@endsection