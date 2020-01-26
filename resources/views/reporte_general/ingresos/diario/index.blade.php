@extends('layouts.main')
@section('title','Reporte General')
@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Reportes</a></li>
  <li><a href="#">Ingresos</a></li>
  <li><a href="#">Diario</a></li>

</ol>
@endsection

@section('content')
<section class="content">
  
{{--   <form action="">
    @include('ingresos_otros.header')
    @include('ingresos_otros.create')
  </form> --}}
  	
  	@include('reporte_general.ingresos.diario.table')

</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {
  var groupColumn = 1;
  $('#tabla-ingresos').DataTable({
    'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "dom": 'Blfrtip',
      "responsive":false,
      "columnDefs": [
            { "visible": false, "targets": groupColumn }
      ],
         "order": [[ groupColumn, 'desc' ]],
        "scrollX": true,
          "buttons": [
          {
            'extend': 'excelHtml5',
            'title': 'Lista Ingresos Diario',
            'attr':  {
              title: 'Excel',
              id: 'excelButton'
            },
            'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
            'className': 'btn btn-default',
            'exportOptions':
            {
              columns:[0,1,2,3,4,5,6]
            }
          }],
		'ajax': `./reporte_general_ingresos_diario_data`,
		'columns': [
		  {data: 'fecha_reporte'},
		  {data: 'categoria'},
			{data: 'detalle'},
			{data: 'fecha_ingreso'},
			{data: 'codigo_operacion'},
      {data: 'banco'},
			{data: 'monto_ingreso'//, render: $.fn.dataTable.render.number( ',', '.', 0, '$' )
    }
		],
    "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
              if( i == 0 ) {
                $(rows).eq( i ).before(
                      $("<tr style='background-color: #5F9EA0 !important;'></tr>", { 

                    "data-id": group
                }).append($("<td></td>", {
                    "colspan": 5, 
                    "style": "font-weight:bold;"  ,                
                    "text": "TOTAL: " 
                })).append($("<td></td>", {
                  "colspan": 1, 
                    "id": "A",
                    "style": "font-weight:bold;"  ,                     
                    "text":"00.0"
                })).prop('outerHTML'));
              }                
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                      $("<tr style='background-color: #ddd !important;'></tr>", { 

                    "id": ""+group+"",                  
                    "class": "group",
                    "data-id": group
                }).append($("<td></td>", {
                    "colspan": 5, 
                    "style": "font-weight:bold;"  ,                
                    "text": "CATEGORÍA: " + group
                })).append($("<td></td>", {
                     "colspan": 1, 
                    "id": "e" + group,
                    "style": "font-weight:bold;"  ,                     
                    "value": "0.00",
                    "data-id": 0,
                    "text":"00.0"

                })).prop('outerHTML'));
                    last = group;
                }             
                let val  = api.row(api.row($(rows).eq(i)).index()).data();
                //Obtener subtotales +TOTAL
                let elemento            = document.getElementById("e"+val['categoria']);
                let elementoTOTAL       = document.getElementById("A");
                var total               = parseFloat(elementoTOTAL.innerHTML) + 
                                            parseFloat( val['monto_ingreso']);
                elementoTOTAL.innerHTML = parseFloat(total).toFixed(2); 
                let subtotal            = parseFloat(elemento.innerHTML) 
                                            + parseFloat( val['monto_ingreso']);                  
                elemento.innerHTML      = parseFloat(subtotal).toFixed(2);                       
        });   
    }      
  });  
  $('#fecha_reporte2').datepicker(); 
  $('#btn_filter2').click(function() {
    let fecha_reporte =$('#fecha_reporte2').val();
    fecha_reporte = convertDateFormat(fecha_reporte);
    RefreshTable('#tabla-ingresos',`./reporte_general_ingresos_diario_data/${fecha_reporte}`);

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