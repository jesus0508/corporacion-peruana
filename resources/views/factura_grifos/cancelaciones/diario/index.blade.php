@extends('layouts.main')

@section('title','Gastos')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css"></link> 
<link src="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css"></link> 
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet"></link>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Grifos</a></li>
  <li><a href="#">Venta Facturada</a></li>
  <li><a href="#">Lista Cancelación</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('factura_grifos.cancelaciones.diario.header')
  @include('factura_grifos.cancelaciones.diario.table')

  <!--/.end-modales-->
</section>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="//cdn.rawgit.com/ashl1/datatables-rowsgroup/v1.0.0/dataTables.rowsGroup.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
  $('#tabla-cancelaciones-total').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "responsive": false, 
      "columnDefs": [
        {"className": "dt-center", "targets":  [0,1,2,3,4,5,6,7,8]  },
        {"targets": [ 11 ],   "visible": false }
                      ],
      'rowsGroup':[0,1,2,3,4,5,6,7,8],
      "scrollX": true,
      "dom": 'Blfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Cancelaciones Grifos',
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
              //let total = $('c[r=F'+nRows+'] t', sheet).text();
              $('row:last c t', sheet).text( '' );
              showExcelSubtotal(sheet,nRows,'J','Total Depósitos');               
            },
        'exportOptions':
        {
          columns:[0,1,2,3,4,5,6,7,8,9,10]
        },
        footer: true
      }], 

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            getSubtotal(api,10);
      }
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

	function inicializarSelect2($select, text, data) {
    $select.prop('selectedIndex', -1);
    $select.select2({
      placeholder: text,
      allowClear: true,
      data: data
      });
  }
      $('#fecha_inicio_month').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
            onClose: function(dateText, inst) { 
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                }
      });
  function validateDatesMonth(){
    //let $tabla_pagos_lista = $('#tabla-cancelaciones-total');
      $('#fecha_inicio_month').datepicker({
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
        var sInicio = $('#fecha_inicio_month').val();
        var sFin = $('#fecha_inicio_month').val();
        let cell = data[7];
        if (sInicio) {
          return sInicio === cell;
        }
        return true;
      }
    );
  }

  function validateDates() {
    let $tabla_pagos_lista = $('#tabla-cancelaciones-total');
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
      $('#fecha_inicio_month').val("");
      $('#fecha_fin').val("");
      $tabla_pagos_lista.DataTable().draw();
      $('#filter-grifo').val('').trigger('change');
    });
  }

$(document).ready(function() {
    validateDatesMonth();
    validateDates();
    let $filter_proveedor = $('#filter-grifo');
    let $tabla_pedido_proveedores = $('#tabla-cancelaciones-total');
    inicializarSelect2($filter_proveedor, 'Ingrese el grifo', '');
      $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      let grifo = $filter_proveedor.find('option:selected').text();
      let cell = data[1];
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