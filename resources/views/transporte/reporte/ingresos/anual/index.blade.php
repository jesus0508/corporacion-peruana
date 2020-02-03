@extends('layouts.main')
@section('title','Reporte')
@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Reportes</a></li>
  <li><a href="#">Transporte</a></li>
  <li><a href="#">Ingresos</a></li>
  <li><a href="#">Anual</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('transporte.reporte.ingresos.anual.header')
  @include('transporte.reporte.ingresos.anual.table')

</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script>

$(document).ready(function() {
  $("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years",
    autoclose: true
  });
  $('#tabla-ingresos-netos-mensual').DataTable({
      "dom": 'Blfrtip',
      "responsive":false,
        "scrollX": true,
        'ajax': `./reporte_anual_ingresos_transportes_data`,
          'columns': [
            {data: 'descripcion'},
            {data: '1'},{data: '2'},{data: '3'},{data: '4'},
            {data: '5'},{data: '6'},{data: '7'},{data: '8'},
            {data: '9'},{data: '10'},{data: '11'},{data: '12'}
          ], 
          "buttons": [
          {
            'extend': 'excelHtml5',
            'title': 'Lista Ingresos Anual ',
            'attr':  {
              title: 'Excel',
              id: 'excelButton'
            },
            'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
            'className': 'btn btn-default',
            'exportOptions':
            {
              columns:[0,1,2,3,4,5,6,7,8,9,10,11,12],
              footer: true
            }
          }],
          "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                let cont = 1;
                while(cont<=12){
                  getSubtotal(api,cont);
                  cont++;
                }
          }        
  });  
 
  $("#datepicker").on('change', function () {
    let year_reporte =$('#datepicker').val();    
    RefreshTable('#tabla-ingresos-netos-mensual',`./reporte_anual_ingresos_transportes_data/${year_reporte}`);
  }); 

  $('#yesterday-fecha1').click(function() {    
    let year = $(this).val();
    $('#datepicker').val(year);
    RefreshTable('#tabla-ingresos-netos-mensual',`./reporte_anual_ingresos_transportes_data/${year}`);
  });

  $('#yesterday-fecha').click(function() {    
    let year = $(this).val();
    $('#datepicker').val(year);
    RefreshTable('#tabla-ingresos-netos-mensual',`./reporte_anual_ingresos_transportes_data/${year}`);
  });

  $('#today-fecha').click(function() {    
    let year = $(this).val();  
    $('#datepicker').val(year); 
    RefreshTable('#tabla-ingresos-netos-mensual',`./reporte_anual_ingresos_transportes_data/${year}`);
  });

  $('#today-fecha1').click(function() {    
    let year = $(this).val(); 
    $('#datepicker').val(year);    
    RefreshTable('#tabla-ingresos-netos-mensual',`./reporte_anual_ingresos_transportes_data/${year}`);
  });

});

  function convertDateFormat(string) {
        var info = string.split('/').reverse().join('-');
        return info;
  }
  function getSubtotal(api,column){
    pageTotal = api
                .column( column, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2); 
            $( api.column( column ).footer() ).html(pageTotal);
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