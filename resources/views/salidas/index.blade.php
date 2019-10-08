@extends('layouts.main')
@section('title','Egresos')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Egresos</a></li>
  <li><a href="#">Registro</a></li>
</ol>
@endsection

@section('content')
<section class="content">
   @include('salidas.top_button')
  <form action="">
    @include('salidas.header')
    @include('salidas.create')
  </form>  	
  @include('salidas.table')
	<!-- modales -->
  @include('salidas.modal_categoria')
  <!-- fin modales -->
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
 


$(document).ready(function() {
  $("#categoria_egreso_id").prop("selectedIndex", -1);  

  $("#categoria_egreso_id").select2({
    placeholder: "Seleccione la categoria",
    allowClear:true
  });

  $("#cuenta_id").prop("selectedIndex", -1);
  $("#cuenta_id").select2({
    placeholder: "Seleccione la cuenta",
    allowClear:true
  });

  $('#fecha_reporte').datepicker({
   //minDate: 0,
  });
 $('#fecha_egreso').datepicker({
   //minDate: 0,
  });
 $('#fecha_reporte2').datepicker({
   //minDate: 0,
  }); 


  $('#tabla-egresos').DataTable({
    'language': {
      'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
		'ajax': `../egresos_dt`,
		'columns': [
		  {data: 'fecha_reporte'},
		  {data: 'categoria'},
			{data: 'detalle'},
			{data: 'fecha_egreso'},
			{data: 'codigo_operacion'},
			{data: 'monto_egreso', render: $.fn.dataTable.render.number( ',', '.', 0, 'S/. ' )}
		]      
  }); 
  function convertDateFormat(string) {
        var info = string.split('/').reverse().join('-');
        return info;
  }
	function RefreshTable(tableId, urlData){
  	$.getJSON(urlData, null, function( json ){
    	table = $(tableId).dataTable();
   		oSettings = table.fnSettings();
    	table.fnClearTable(this);    
    	//console.log(json.data);
    	for (var i=0; i<json.data.length; i++) {
      	table.oApi._fnAddData(oSettings, json.data[i]);      	
     	} 
    	oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();    	
    	table.fnDraw();
   
  	});
	}

	$('#btn_filter2').click(function() {
	  let fecha_reporte =$('#fecha_reporte2').val();
    fecha_reporte = convertDateFormat(fecha_reporte);	
		RefreshTable('#tabla-egresos',`../egresos_dt/${fecha_reporte}`);
	});

  $('#btn_register').click(function(e){//store GASTO
    e.preventDefault();
    let categoria_egreso_id = $('#categoria_egreso_id').val();   
    let monto_egreso =$('#monto_egreso').val();
    let fecha_egreso =$('#fecha_egreso').val();
     fecha_egreso = convertDateFormat(fecha_egreso);
    let fecha_reporte =$('#fecha_reporte').val();
    fecha_reporte = convertDateFormat(fecha_reporte);    
    let codigo_operacion =$('#codigo_operacion').val();  
    let cuenta_id = $('#cuenta_id option:selected').val();
    let detalle =$('#detalle').val();
    let token =$('#token').val();
   // console.log(cuenta_id);
    $.ajax({
        url: `../salidas`,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{
          cuenta_id: cuenta_id,
          monto_egreso: monto_egreso,
          fecha_reporte: fecha_reporte,  
          fecha_egreso: fecha_egreso,
          categoria_egreso_id: categoria_egreso_id,
          detalle: detalle,
          codigo_operacion: codigo_operacion
        }

    }).done(function (data){
      //console.log('done');
        $('#monto_egreso').val('');
        $('#detalle').val('');
  			$('#codigo_operacion').val('');	
        $('#cuenta_id').val('').trigger('change');
      RefreshTable('#tabla-egresos',`../egresos_dt/${fecha_reporte}`);
      toastr.success(data.status, 'Egreso registrado con éxito', { timeOut: 2000 });
    });    
  });

});
</script>
@endsection