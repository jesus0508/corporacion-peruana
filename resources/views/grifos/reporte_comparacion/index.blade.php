@extends('layouts.main')
@section('title','Reporte Comparacion')
@section('styles')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Reportes</a></li>
  <li><a href="#">Grifos Ingresos</a></li>
  <li><a href="#">Comparación</a></li>

</ol>
@endsection

@section('content')
<section class="content">
  
  @include('grifos.reporte_comparacion.table')

</section>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {

  $('#tabla-comparaciones').DataTable({
    "dom": 'Blfrtip',
    "responsive":false,
		'ajax': `./reporte_comparacion_grifos_data`,
		'columns': [
      {data: 'fecha_ingreso'},            
      {data: 'grifo'},
      {data: 'ingreso_neto'},
      {data: 'ingreso_movimiento_total'},
      {data: 'diferencia' }
		],      
    "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Reporte Comparacion Ingresos Grifos',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default',
        customize: function( xlsx ) {
              var sheet = xlsx.xl.worksheets['sheet1.xml'];
              let rels = xlsx.xl.worksheets['sheet1.xml'];
              var clR = $('row', sheet);               
              let nRows = clR.length;
              //let total = $('c[r=F'+nRows+'] t', sheet).text();              
              $('row:last c t', sheet).text( '' );
              showExcelSubtotal(sheet,nRows,'B','Totales');                                    
            },
        'exportOptions':
        {
          columns:[0,1,2,3,4]
        },
        footer: true
      }], 

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Total over this page
            getSubtotal(api,2);
            getSubtotal(api,3);
            getSubtotal(api,4);
      }

        
  });  

  $('#fecha_reporte2').datepicker(); 
  $('#btn_filter2').click(function() {
    let fecha_reporte =$('#fecha_reporte2').val();
    fecha_reporte = convertDateFormat(fecha_reporte);
    RefreshTable('#tabla-comparaciones',`./reporte_comparacion_grifos_data/${fecha_reporte}`);
  });

});
  function convertDateFormat(string) {
        var info = string.split('/').reverse().join('-');
        return info;
  }

  function convertDateFormat(string) {
        var info = string.split('/').reverse().join('-');
        return info;
  }

 function showExcelSubtotal(sheet,nRows,letter,text){
    $('c[r='+letter+nRows+'] t', sheet).text(text);
    $('c[r='+letter+nRows+'] t', sheet).attr('s','37');//Negrita
  }

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