@extends('layouts.main')

@section('title','Transporte')

@section('styles')
  @include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Transporte</a></li>
  <li><a href="#">Registro Egreso</a></li>
</ol>
@endsection


@section('content')
<section class="content">
  @include('transporte.egresos.create')
  @include('transporte.egresos.table')
  
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {

  let $select_placa = $('#placa');
  let $select_tipo = $('#tipo');
  let $select_tipo_comprobante = $('#tipo_comprobante');
  let $table = $('#tabla-egreso-transporte');
	inicializarSelect2($select_placa,'Seleccione placa','');
  inicializarSelect2($select_tipo,'Seleccione el tipo','');
  inicializarSelect2($select_tipo_comprobante,'Seleccione el tipo','');
	$('#fecha_reporte').datepicker();
 	$('#fecha_egreso').datepicker();
 	let fecha_reporte = $('#fecha_reporte').val(); 
	inicializarDataTable($table,'');

  $select_tipo.on('change', function (event) {
    //console.log('cambió');
    let id = $select_tipo.val();
      id = (id)?id:-1;   
    fillSeries(id);       
  });

});

function fillSeries(idTipo){
    getPlacaByTipo(idTipo).done((data) => {
    //console.log(data);     
    $('#placa').html('');
    inicializarSelect2Less($('#placa'), 'Seleccione la placa', data.transporte);
    //$('#placa').val(data.transportes);
    //evaluateSeries();
    }).fail((error) => {
      toastr.error('Ocurrio un error en el servidor!', 'Error Alert', { timeOut: 2000 });
    });
  }
function getPlacaByTipo(idTipo) {
    return $.ajax({
      type: 'GET',
      url: `../placas_transporte/${idTipo}`,
      dataType: 'json',
    });
  }
function inicializarDataTable($table, fecha_reporte){
	 $table.DataTable({
      "responsive": false,
      "columnDefs": [{
          "targets": [8],
          "visible": false
      }],
      "dom": 'Blfrtip',
      "scrollX": true,
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
              $('c[r=G'+nRows+'] t', sheet).text('TOTAL:' );
              $('c[r=G'+nRows+'] t', sheet).attr('s','37');
              $('c[r=H'+nRows+'] t', sheet).text( total );
              $('c[r=H'+nRows+'] t', sheet).attr('s','37');            
			       },
        'exportOptions':
        {
          columns:[0,1,2,3,4,5,6,7]
        },
        footer: true
      }], 

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            pageTotal = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);
            $( api.column( 7 ).footer() ).html(pageTotal);
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
  function inicializarSelect2Less($select, text, data) {
    $select.select2({
      placeholder: text,
      data: data
    });
  }
  function validateDates() {
  let $tabla_pagos_lista = $('#tabla-egreso-transporte');
  $('#fecha_inicio').datepicker({
    numberOfMonths: 1,
    onSelect: function (selected) {
      $('#fecha_fin').datepicker('option', 'minDate', selected)
    }
  });

  $('#fecha_inicio2').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
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
      var dia = $.datepicker.parseDate('d/m/yy', data[0]);
      if (!inicio || !dia || fin >= dia && inicio <= dia) {
        return true;
      }
      return false;
    }
  );

  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $('#fecha_inicio2').val();
      let cell = data[8];
      if (sInicio) {
        return sInicio === cell;
      }
      return true;
    }
  );



  $('#filtrar-fecha').on('click', function () {
    $tabla_pagos_lista.DataTable().draw();
  });

  $('#filtrar-fecha-mes').on('click', function () {
    $tabla_pagos_lista.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio2').val("");   
    $('#fecha_inicio').val("");
    $('#fecha_fin').val("");
    $tabla_pagos_lista.DataTable().draw();
    $('#filter-grifo').val('').trigger('change');
    $('#filter-tipo').val('').trigger('change');
  });

}
$(document).ready(function() {
    validateDates();
    let $filter_placa = $('#filter-grifo');
    let $filter_tipo      = $('#filter-tipo');        
    let $tabla_egreso_transporte = $('#tabla-egreso-transporte');
    inicializarSelect2($filter_placa, 'Placa', '');
    inicializarSelect2($filter_tipo, 'Tipo', '');  
    //filter placa      
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
      let placa = $filter_placa.find('option:selected').text();
      let cell = data[3];
      if (placa) {
        return placa === cell;
      }
      return true;
    });

    //filter tipo      
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
      let tipo = $filter_tipo.find('option:selected').text();
      let cell = data[2];
      if (tipo) {
        return tipo === cell;
      }
      return true;
    });   

  $filter_placa.on('change', function () {
    $tabla_egreso_transporte.DataTable().draw();
  });

  $filter_tipo.on('change', function () {
    $tabla_egreso_transporte.DataTable().draw();
  });  
} );
</script>
@endsection
