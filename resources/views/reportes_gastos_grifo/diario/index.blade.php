@extends('layouts.main')

@section('title','Gastos Grifos')

@section('styles')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Reportes</a></li>
  <li><a href="#">Gastos Grifos</a></li>
  <li><a href="#">Diario</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('reportes_gastos_grifo.diario.filtrado')
  @include('reportes_gastos_grifo.diario.table')

  <!--/.end-modales-->
</section>
@endsection


@section('scripts')
@include('reporte_excel.excel_select2_js')

<script>
$(document).ready(function() {
  $('#tabla-gastos-grifo-diarios').DataTable({
      'ajax': `./reporte_egresos_grifos_diario_data`,
      'columns': [
        {data: 'fecha_egreso'},
        {data: 'grifo.razon_social'},
        {data: 'concepto_gasto.sub_categoria_gasto.categoria_gasto.categoria'},
        {data: 'concepto_gasto.sub_categoria_gasto.subcategoria'},
        {data: 'concepto_gasto.concepto'},
        {data: 'monto_egreso'}
        ],
      "responsive": true,
      "dom": 'Bfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Gastos Grifos',
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
              $('c[r=E'+nRows+'] t', sheet).text('TOTAL:' );
              $('c[r=E'+nRows+'] t', sheet).attr('s','37');
              $('c[r=F'+nRows+'] t', sheet).text( total );
              $('c[r=F'+nRows+'] t', sheet).attr('s','37');             
              
            
            },
        'exportOptions':
        {
          columns:[0,1,2,3,4,5]
        },
        footer: true
      }], 

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);
            // Update footer
            $( api.column( 5 ).footer() ).html(
                pageTotal
                // +' (S/.'+ total +' total)'
            );
      }
  });

  $('#fecha_inicio').datepicker(); 
  $('#filtrar-fecha').click(function() {
    let fecha_reporte =$('#fecha_inicio').val();
    fecha_reporte = convertDateFormat(fecha_reporte);
    RefreshTable('#tabla-gastos-grifo-diarios',`./reporte_egresos_grifos_diario_data/${fecha_reporte}`);

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
  let $tabla_pagos_lista = $('#tabla-gastos-grifo-diarios');
  $('#clear-fecha').on('click', function () {
    $('#filter-grifo').val('').trigger('change');
  });

  $('#today-fecha').on('click', function () {
    let today_date = $('#today-fecha').val();
    today_date = convertDateFormat(today_date);
    $('#fecha_inicio').val(today_date);
    RefreshTable('#tabla-gastos-grifo-diarios',`./reporte_egresos_grifos_diario_data/${today_date}`);
  });
  
  $('#yesterday-fecha').on('click', function () {
    let yesterday_date = $('#yesterday-fecha').val();
    yesterday_date = convertDateFormat(yesterday_date);
    $('#fecha_inicio').val(yesterday_date);
    RefreshTable('#tabla-gastos-grifo-diarios',`./reporte_egresos_grifos_diario_data/${yesterday_date}`);
  });
}

$(document).ready(function() {
    validateDates();
    let $filter_grifo = $('#filter-grifo');
    let $tabla_egresos_grifo = $('#tabla-gastos-grifo-diarios');
    inicializarSelect2($filter_grifo, 'Seleccione el grifo', '');
    $.fn.dataTable.ext.search.push(
      function (settings, data, dataIndex) {
        let grifo = $filter_grifo.find('option:selected').text();
        let cell = data[1];
        if (grifo) {
          return grifo === cell;
        }
        return true;
      });
    $filter_grifo.on('change', function () {
      $tabla_egresos_grifo.DataTable().draw();
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