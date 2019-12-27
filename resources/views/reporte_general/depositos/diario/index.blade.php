@extends('layouts.main')
@section('title','Reporte General')
@section('styles')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Reportes</a></li>
  <li><a href="#">Depositos</a></li>
  <li><a href="#">Diario</a></li>

</ol>
@endsection

@section('content')
<section class="content">
  
  @include('reporte_general.depositos.diario.table')

</section>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {

  $('#tabla-depositos').DataTable({
    'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "dom": 'Blfrtip',
      "responsive":false,
      "scrollX": true,
          "buttons": [
          {
            'extend': 'excelHtml5',
            'title': 'Lista Depositos Diario',
            'attr':  {
              title: 'Excel',
              id: 'excelButton'
            },
            'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
            'className': 'btn btn-default',
            'exportOptions':
            {
              columns:[0,1,2,3,4]
            }
          }],
		'ajax': `./reporte_general_depositos_diario_data`,
		'columns': [
      {data: 'fecha_reporte'},            
      {data: 'nro_cuenta'},
      {data: 'detalle'},
      {data: 'codigo_operacion'},
      {data: 'monto' }
		]                       
        
  });  
  $('#fecha_reporte2').datepicker(); 
  $('#btn_filter2').click(function() {
    let fecha_reporte =$('#fecha_reporte2').val();
    fecha_reporte = convertDateFormat(fecha_reporte);
    RefreshTable('#tabla-depositos',`./reporte_general_depositos_diario_data/${fecha_reporte}`);

  });
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
    	for (var i=0; i<json.data.length; i++) {
      	table.oApi._fnAddData(oSettings, json.data[i]);      	
     	} 
    	oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();    	
    	table.fnDraw();
   
  	});
	}

</script>
@endsection