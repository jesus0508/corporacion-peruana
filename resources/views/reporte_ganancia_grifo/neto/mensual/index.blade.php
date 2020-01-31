@extends('layouts.main')

@section('title','Ingresos Grifos')

@section('styles')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
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
  <li><a href="#">Ingreso Neto Grifos</a></li>
  <li><a href="#">Mensual</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('reporte_ganancia_grifo.neto.mensual.header')
  @include('reporte_ganancia_grifo.neto.mensual.table')

  <!--/.end-modales-->
</section>
@endsection


@section('scripts')
@include('reporte_excel.excel_select2_js')

<script>
$(document).ready(function() {
  var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

  $('#tabla-ingresos-netos-mensual').DataTable({
      'ajax': `../reporte_ingresos_grifos_mensual_data`,
      'columns': [
          {data: 'fecha_ingreso'},
          {data: 'grifo'},
          {data: 'monto_ingreso'},
          {data: 'monto_egreso'},
          {data: 'monto_neto'},
        ],
      "responsive": false,
      "scrollX": true,
      "dom": 'Bfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Ingreso Neto Grifos Mensual',
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
              $('c[r=C'+nRows+'] t', sheet).text('TOTAL:' );
              $('c[r=C'+nRows+'] t', sheet).attr('s','37');
              $('c[r=D'+nRows+'] t', sheet).text( total );
              $('c[r=D'+nRows+'] t', sheet).attr('s','37');             
              
            
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
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);
            // Update footer
            $( api.column( 4 ).footer() ).html(
                pageTotal
                // +' (S/.'+ total +' total)'
            );
      }
  });

  $('#fecha_inicio').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'MM yy',
    onClose: function(dateText, inst) { 
        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        },
    autoclose: true
  }); 
  $('#filtrar-fecha').click(function() {
    let fecha_reporte =$('#fecha_inicio').val();
    let porciones = fecha_reporte.split(' ');
    let mes = porciones[0];
    let year = porciones[1];
    meses.forEach( function(valor, indice, array) {
      if (valor==mes) {
        mes = indice+1;
      }
    });
    fecha_reporte = mes + '-' + year;
    RefreshTable('#tabla-ingresos-netos-mensual',`../reporte_ingresos_grifos_mensual_data/${fecha_reporte}`);

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
  let $tabla_pagos_lista = $('#tabla-ingresos-netos-mensual');
  $('#clear-fecha').on('click', function () {
    $('#filter-grifo').val('').trigger('change');
  });

  $('#today-fecha').on('click', function () {
    let this_month_year_my = $('#month_actual_date_my').val();
    let this_month_year = $('#month_actual_date').val();
    $('#fecha_inicio').val(this_month_year);
    RefreshTable('#tabla-ingresos-netos-mensual',`../reporte_ingresos_grifos_mensual_data/${this_month_year_my}`);
  });
  
  $('#yesterday-fecha').on('click', function () {
    let last_month_date_my = $('#last_month_date_my').val();
    let last_month_date = $('#last_month_date').val();
    $('#fecha_inicio').val(last_month_date);
    RefreshTable('#tabla-ingresos-netos-mensual',`../reporte_ingresos_grifos_mensual_data/${last_month_date_my}`);
  });
}

$(document).ready(function() {
    validateDates();
    let $filter_grifo = $('#filter-grifo');
    let $tabla_egresos_grifo = $('#tabla-ingresos-netos-mensual');
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