@extends('layouts.main')

@section('title','Neto Grifos')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet"></link>
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
  @include('reporte_ganancia_grifo.reporte_detallado.table')
  <!--/.end-modales-->
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
  $('#tabla-ganancia-grifo').DataTable({
      "responsive": true,
      "dom": 'Blfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Ingresos Grifo Neto Detallado',
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
          columns:[1,2,3,4,5]
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
  let $tabla_pagos_lista = $('#tabla-ganancia-grifo');
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
      var dia = $.datepicker.parseDate('d/m/yy', data[2]);
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

$('#today-fecha').on('click', function () {
    let hoy = $('#today_date').val();
    //console.log(hoy);
    $('#fecha_inicio').val(hoy);
    $('#fecha_fin').val(hoy);
    $tabla_pagos_lista.DataTable().draw();
  });
$('#yesterday-fecha').on('click', function () {
   let ayer = $('#yesterday_date').val();
   // console.log(ayer);
    $('#fecha_inicio').val(ayer);
    $('#fecha_fin').val(ayer);
    $tabla_pagos_lista.DataTable().draw();
  });
}

$(document).ready(function() {
    validateDates();
    let $filter_proveedor = $('#filter-grifo');
    let $tabla_pedido_proveedores = $('#tabla-ganancia-grifo');
    inicializarSelect2($filter_proveedor, 'Ingrese el grifo', '');
      $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      let grifo = $filter_proveedor.find('option:selected').text();
      let cell = data[3];
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