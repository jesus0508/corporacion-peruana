@extends('layouts.main')
@section('title','Reporte General')
@section('styles')
@include('reporte_excel.excel_select2_css')
<style>
    .ui-datepicker-calendar {
        display: none;
    }
</style>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Reportes</a></li>
  <li><a href="#">Ingresos</a></li>
  <li><a href="#">Mensual</a></li>

</ol>
@endsection

@section('content')
<section class="content">
  @include('reporte_general.ingresos.mensual.header')
  @include('reporte_general.ingresos.mensual.table2')
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {
  var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
  var groupColumn = 0;
  $('#tabla-ingresos').DataTable({
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
            'title': 'Lista Ingresos Mensual',
            'attr':  {
              title: 'Excel',
              id: 'excelButton'
            },
            'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
            'className': 'btn btn-default',
            'exportOptions':
            {
              columns:[0,1,2,3,4,5]
            }
          }],
		'ajax': `./reporte_general_ingresos_mensual_data`,
		'columns': [
		  // {data: 'fecha_reporte'},
		  {data: 'categoria'},
			{data: 'detalle'},
			{data: 'fecha_ingreso','render': function(data){
        return getDate(data);
      } },
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
                    "colspan": 4, 
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
                    "colspan": 4, 
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

  $('#fecha_reporte2').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            },
        autoclose: true
  });

  $('#btn_filter2').click(function() {
    let fecha_reporte =$('#fecha_reporte2').val();
    let porciones = fecha_reporte.split(' ');
    let mes = porciones[0];
    let year = porciones[1];
    meses.forEach( function(valor, indice, array) {
      if (valor==mes) {
        mes = indice+1;
      }
    });
    fecha_reporte = mes + '-' + year;
    RefreshTable('#tabla-ingresos',`./reporte_general_ingresos_mensual_data/${fecha_reporte}`);
  });

  $('#today-fecha').on('click', function () {
    let this_month_year_my = $('#month_actual_date_my').val();
    let this_month_year = $('#month_actual_date').val();
    $('#fecha_reporte2').val(this_month_year);
      RefreshTable('#tabla-ingresos',`./reporte_general_ingresos_mensual_data/${this_month_year_my}`);
  });

  $('#yesterday-fecha').on('click', function () {
    let last_month_date_my = $('#last_month_date_my').val();
    let last_month_date = $('#last_month_date').val();
    $('#fecha_reporte2').val(last_month_date);
      RefreshTable('#tabla-ingresos',`./reporte_general_ingresos_mensual_data/${last_month_date_my}`);
  });

});

  function getDate(date){
    if ( date.includes('-')) {
      date = convertDateFormat2(date);
      return date;
    }
    return date;
  }
  
  function convertDateFormat(string) {
        var info = string.split('/').reverse().join('-');
        return info;
  }

  function convertDateFormat2(string) {
        var info = string.split('-').reverse().join('/');
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