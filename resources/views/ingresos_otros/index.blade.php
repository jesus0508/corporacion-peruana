@extends('layouts.main')
@section('title','Ingresos')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ingresos</a></li>
  <li><a href="#">Registro</a></li>
</ol>
@endsection

@section('content')
<section class="content">
   @include('ingresos_otros.top_button')
  <form action="">
    @include('ingresos_otros.header')
    @include('ingresos_otros.create')
  </form>
  	
  	@include('ingresos_otros.table')

	<!-- modales -->
   @include('ingresos_otros.modal_categoria')
   <!-- fin modales -->
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
$(document).ready(function() {

  $('#tabla-ingresos').DataTable({
    'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
    //"bProcessing": true,
		//'serverSide': true, Kga el filtrado u.u
		'ajax': `../ingresos_otros_dt`,
		'columns': [
		  {data: 'fecha_reporte'},
		  {data: 'categoria'},
			{data: 'detalle'},
			{data: 'fecha_ingreso'},
			{data: 'codigo_operacion'},
			{data: 'monto_ingreso', render: $.fn.dataTable.render.number( ',', '.', 0, '$' )}
		]      
  }); 

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
		RefreshTable('#tabla-ingresos',`../ingresos_otros_dt/${fecha_reporte}`);

	});

  $('#btn_register').click(function(e){//store GASTO
    e.preventDefault();
    let categoria_ingreso_id = $('#categoria_ingreso_id').val();   
    let monto_ingreso =$('#monto_ingreso').val();
    let fecha_ingreso =$('#fecha_ingreso').val();
    let fecha_reporte =$('#fecha_reporte').val();
    let codigo_operacion =$('#codigo_operacion').val();  
    let detalle =$('#detalle').val();
    let token =$('#token').val();
    $.ajax({
        url: `../ingresos_otros`,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{
          monto_ingreso: monto_ingreso,
          fecha_reporte: fecha_reporte,  
          fecha_ingreso: fecha_ingreso,
          categoria_ingreso_id: categoria_ingreso_id,
          detalle: detalle,
          codigo_operacion: codigo_operacion
        }

    }).done(function (data){
        $('#monto_ingreso').val('');
        $('#detalle').val('');
  			$('#codigo_operacion').val('');	
      RefreshTable('#tabla-ingresos',`../ingresos_otros_dt/${fecha_reporte}`);
      toastr.success(data.status, 'Ingreso registrado con éxito', { timeOut: 2000 });
    });    
  });

});
</script>
@endsection