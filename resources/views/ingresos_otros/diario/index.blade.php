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

  	@include('ingresos_otros.diario.buttons_top')
  	@include('ingresos_otros.diario.table')

	<!-- modales -->
   @include('ingresos_otros.modal_categoria')
   <!-- fin modales -->
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
$(document).ready(function() {
	var groupColumn = 1;
  $('#tabla-reporte-ingresos').DataTable({
  	"columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
    "order": [[ groupColumn, 'asc' ]],
    'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
    "ordering": false,
    "searching": false,
		"drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" style="background-color: #ddd !important;"><td colspan="6"><b>'+group+'</b></td></tr>'
                    ); 
                    last = group;
                }
            });
    }
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

	$('#btn_filter').click(function() {
		let fecha_reporte =$('#fecha_reporte').val();		
		RefreshTable('#tabla-ingresos',`../ingresos_otros_dt/${fecha_reporte}`);

	});
});
</script>
@endsection