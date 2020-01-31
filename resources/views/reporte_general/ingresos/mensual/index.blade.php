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
  <br>
  @include('reporte_general.ingresos.mensual.table')

</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {
var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
  $('#tabla-ingresos').DataTable({
      "dom": 'Blfrtip',
      'ajax': `./reporte_general_ingresos_mensual_data`,
      'columns': [
        {data: 'nro'},
        {data: 'fecha_name'}, 
        {data: 'fecha_ingreso'},     
        {data: 'monto_ingreso'}
      ],
      "responsive":  true,
      "pageLength": 31,
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
            customize: function( xlsx ) {
              var sheet = xlsx.xl.worksheets['sheet1.xml'];
              let rels = xlsx.xl.worksheets['sheet1.xml'];
              var clR = $('row', sheet);               
              let nRows = clR.length;
              //let total = $('c[r=F'+nRows+'] t', sheet).text();              
              $('row:last c t', sheet).text( '' );
              showExcelSubtotal(sheet,nRows,'C','Total');                                     
            },
            'exportOptions':
            {
              columns:[1,2,3]
            },
            'footer': true
          }],
          "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                getSubtotal(api,3);
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