@extends('layouts.main')

@section('title','Empresa')

@section('styles')
  @include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Empresa</a></li>
  <li><a href="#">Gastos Gerencia</a></li>
</ol>
@endsection


@section('content')
<section class="content">
  @include('empresa.egresos_gerencia.create')
  @include('empresa.egresos_gerencia.table')
  @include('empresa.egresos_gerencia.pagar_modal')
  
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {
  
  let $tabla = $('#tabla-egreso-gerencia');
  let $fecha = $('#fecha');
  let $fecha_egreso = $('#fecha_egreso');
  let $fecha_reporte = $('#fecha_reporte');
  $('#fecha_inicio').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
  });
  inicializarDataTable($tabla);
  $fecha.datepicker();
  $fecha_egreso.datepicker();
  $fecha_reporte.datepicker();  
});


function validateDates() {
  let $tabla_pagos_lista = $('#tabla-egreso-gerencia');
  $('#fecha_inicio').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
  });

  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $('#fecha_inicio').val();
      var sFin = $('#fecha_inicio').val();
      let cell = data[7];
      if (sInicio) {
        return sInicio === cell;
      }
      return true;
    }
  );

  $('#filtrar-fecha').on('click', function () {
    $tabla_pagos_lista.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $tabla_pagos_lista.DataTable().draw();
  });
}

$(document).ready(function() {
    validateDates();
} );

function inicializarDataTable($table){  
	 $table.DataTable({
      "responsive": false,
      "dom": 'Blfrtip',
      "scrollX": true,
      columnDefs: [ 
        { visible: false, targets: [ -1 ] }] ,
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Gastos Gerencia',
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
			       },
        'exportOptions':
        {
          columns:[0,1,2,3,4,5]
        },
        footer: true
      }], 

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);
            $( api.column( 5 ).footer() ).html(pageTotal);
            pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);
            $( api.column( 6 ).footer() ).html(pageTotal);      

      }
  });

}


</script>
@endsection
