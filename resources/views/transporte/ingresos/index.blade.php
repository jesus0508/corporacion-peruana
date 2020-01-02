@extends('layouts.main')

@section('title','Transporte')

@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Transporte</a></li>
  <li><a href="#">Registro Ingreso</a></li>
</ol>
@endsection


@section('content')
<section class="content">
  @include('transporte.ingresos.create')
  @include('transporte.ingresos.table') 
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {

  let $select_placa = $('#placa');
  let $table = $('#tabla-ingreso-transporte');
	inicializarSelect2($select_placa,'Seleccione placa','');
	$('#fecha_reporte').datepicker();
 	$('#fecha_ingreso').datepicker();
 	let fecha_reporte = $('#fecha_reporte').val(); 
	inicializarDataTable($table,'');

});

function inicializarDataTable($table, fecha_reporte){
	 $table.DataTable({
      "responsive": true,
      "dom": 'Blfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': fecha_reporte+' Alquiler de Buses',
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

}
function inicializarSelect2($select, text, data) {
  $select.prop('selectedIndex', -1);
  $select.select2({
    placeholder: text,
    allowClear: true,
    data: data
    });
  }

function validateDates() {
  let $tabla_pagos_lista = $('#tabla-ingreso-transporte');
  $('#fecha_inicio').datepicker({
    numberOfMonths: 1,
    onSelect: function (selected) {
      $('#fecha_fin').datepicker('option', 'minDate', selected)
    }
  });
  $('#fecha_fin').datepicker({
    numberOfMonths: 1,
    onSelect: function (selected) {
      $('#fecha_inicio').datepicker('option', 'maxDate', selected)
    }
  });

  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $('#fecha_inicio').val();
      var sFin = $('#fecha_inicio').val();
      var inicio = $.datepicker.parseDate('d/m/yy', sInicio);
      var fin = $.datepicker.parseDate('d/m/yy', sFin);
      var dia = $.datepicker.parseDate('d/m/yy', data[1]);
      if (!inicio || !dia || fin >= dia && inicio <= dia) {
        return true;
      }
      return false;
    }
  );

  $('#filtrar-fecha').on('click', function () {
    $tabla_pagos_lista.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $('#fecha_fin').val("");
    $tabla_pagos_lista.DataTable().draw();
    $('#filter-grifo').val('').trigger('change');
  });

}
$(document).ready(function() {
    validateDates();
    let $filter_proveedor = $('#filter-grifo');
    let $tabla_pedido_proveedores = $('#tabla-ingreso-transporte');
    inicializarSelect2($filter_proveedor, 'Ingrese la placa', '');
      $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      let grifo = $filter_proveedor.find('option:selected').text();
      let cell = data[2];
      if (grifo) {
        return grifo === cell;
      }
      return true;
    }

  );

  $filter_proveedor.on('change', function () {
    $tabla_pedido_proveedores.DataTable().draw();
  });
} );
</script>
@endsection