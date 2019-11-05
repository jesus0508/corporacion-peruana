@extends('layouts.main')

@section('title','Transporte')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet"></link>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Transporte</a></li>
  <li><a href="#">Registro Ingreso</a></li>
</ol>
@endsection


@section('content')
<section class="content">
  @include('transporte.egresos.create')
  @include('transporte.egresos.table')
  
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
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
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "responsive": true,
      "dom": 'Bfrtip',
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
              $('c[r=F'+nRows+'] t', sheet).text('TOTAL:' );
              $('c[r=F'+nRows+'] t', sheet).attr('s','37');
              $('c[r=G'+nRows+'] t', sheet).text( total );
              $('c[r=G'+nRows+'] t', sheet).attr('s','37');            
			       },
        'exportOptions':
        {
          columns:[0,1,2,3,4,5,6]
        },
        footer: true
      }], 

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);
            // Update footer
            $( api.column( 6 ).footer() ).html(
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
    let $tabla_pedido_proveedores = $('#tabla-egreso-transporte');
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
