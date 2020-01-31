@extends('layouts.main')

@section('title','Neto Grifos')

@section('styles')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Reportes</a></li>
  <li><a href="#">Reportes Diario</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('reporte_ganancia_grifo.reporte_detallado.header')
  @include('reporte_ganancia_grifo.reporte_detallado.table_ingresos')
  @include('reporte_ganancia_grifo.reporte_detallado.table_egresos')
  <!--/.end-modales-->
</section>
@endsection


@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {
  $('#tabla-ingreso-grifo').DataTable({
      'ajax': `./reporte_ingresos_detallado_diario_data`,
      'columns': [
          {data: 'fecha_reporte'},
          {data: 'fecha_ingreso'},
          {data: 'grifo'},
          {data: null , "defaultContent": "Ingreso Por Grifo"},
          {data: 'monto'},
        ],
      "responsive": false,
      "paging":   false,
      "info": false,
      //'searching': false,    
      "scrollX": true,
      "dom": 'Blfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Ingreso Detallado',
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
              
              let nRows = clR.length;//6
              let total = $('c[r=F'+nRows+'] t', sheet).text();                
              $('row:last c t', sheet).text( '' );
              $('c[r=D'+nRows+'] t', sheet).text('TOTAL:' );
              $('c[r=D'+nRows+'] t', sheet).attr('s','37');
              $('c[r=E'+nRows+'] t', sheet).text( total );
              $('c[r=E'+nRows+'] t', sheet).attr('s','37');             
            },
        'exportOptions':
        {
          columns:[0,1,2,3,4]
        },
        footer: true
      }], 

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data; 
            pageTotal = api.column( 4, { page: 'current'} ).data().reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);
            $( api.column( 4 ).footer() ).html(pageTotal);
      }
  });
  $('#tabla-egreso-grifo').DataTable({
      'ajax': `./reporte_egresos_detallado_diario_data`,
      'columns': [
          {data: 'fecha_reporte'},
          {data: 'fecha_egreso'},
          {data: 'grifo'},
          {data: 'detalle'},
          {data: 'monto'},
        ],
      "paging":   false,
      "info": false,
     // 'searching': false,    
      "responsive": false,
      "scrollX": true,
      "dom": 'Blfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Egreso Detallado',
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
              
              let nRows = clR.length;//6
              let total = $('c[r=F'+nRows+'] t', sheet).text();                
              $('row:last c t', sheet).text( '' );
              $('c[r=D'+nRows+'] t', sheet).text('TOTAL:' );
              $('c[r=D'+nRows+'] t', sheet).attr('s','37');
              $('c[r=E'+nRows+'] t', sheet).text( total );
              $('c[r=E'+nRows+'] t', sheet).attr('s','37');             
            },
        'exportOptions':
        {
          columns:[0,1,2,3,4]
        },
        footer: true
      }], 

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data; 
            pageTotal = api.column( 4, { page: 'current'} ).data().reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);
            $( api.column( 4 ).footer() ).html(pageTotal);
      }
  });

  $('#fecha_inicio').datepicker(); 
  $('#filtrar-fecha').click(function() {
    let fecha_reporte =$('#fecha_inicio').val();
    fecha_reporte = convertDateFormat(fecha_reporte);
    RefreshTable('#tabla-ingreso-grifo',`./reporte_ingresos_detallado_diario_data/${fecha_reporte}`);
    RefreshTable('#tabla-egreso-grifo',`./reporte_egresos_detallado_diario_data/${fecha_reporte}`); 
  });
});

	function inicializarSelect2($select, text, data) {
  $select.prop('selectedIndex', -1);
  $select.select2({
    placeholder: text,
    allowClear: true,
    data: data
    });
  }
function validateDates() {
  let $tabla_pagos_lista = $('#tabla-ingreso-grifo');

  $('#clear-fecha').on('click', function () {
    $('#filter-grifo').val('').trigger('change');
  });


  $('#today-fecha').on('click', function () {
    let today_date = $('#today_date').val();
    $('#fecha_inicio').val(today_date);
    today_date = convertDateFormat(today_date);
    RefreshTable('#tabla-ingreso-grifo',`./reporte_ingresos_detallado_diario_data/${today_date}`);
    RefreshTable('#tabla-egreso-grifo',`./reporte_egresos_detallado_diario_data/${today_date}`); 
  });
  
  $('#yesterday-fecha').on('click', function () {
    let yesterday_date = $('#yesterday_date').val();
    $('#fecha_inicio').val(yesterday_date);
    yesterday_date = convertDateFormat(yesterday_date);
    RefreshTable('#tabla-ingreso-grifo',`./reporte_ingresos_detallado_diario_data/${yesterday_date}`);
    RefreshTable('#tabla-egreso-grifo',`./reporte_egresos_detallado_diario_data/${yesterday_date}`);   
  });
}



$(document).ready(function() {
    validateDates();
    let $filter_grifo = $('#filter-grifo');
    let $tabla_ingreso = $('#tabla-ingreso-grifo');
    let $tabla_egreso = $('#tabla-egreso-grifo');
    inicializarSelect2($filter_grifo, 'Ingrese el grifo', '');
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
      let grifo = $filter_grifo.find('option:selected').text();
      let cell = data[2];
      if (grifo) {
        return grifo === cell;
      }
      return true;
    });

  $filter_grifo.on('change', function () {
    $tabla_ingreso.DataTable().draw();
    $tabla_egreso.DataTable().draw();
  });

});
  $("#getNeto").on('click', function () {
    let subtotal_ingresos = $("#subtotal-ingresos").text();
    let subtotal_egresos = $("#subtotal-egresos").text();
    let total = Number(subtotal_ingresos) + Number(subtotal_egresos);
    $("#total-neto").val(total);
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