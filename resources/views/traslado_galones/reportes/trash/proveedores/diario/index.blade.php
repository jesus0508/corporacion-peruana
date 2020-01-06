@extends('layouts.main')

@section('title','Traspaso')

@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Reporte Proveedores Total Diario </a></li>
</ol>
@endsection


@section('content')
<section class="content">
 {{--  @include('traslado_galones.reporte.proovedores.create') --}}
  @include('traslado_galones.reportes.proveedores.diario.table')
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>

$(document).ready(function() {

	  $('#tabla-traslado-galones').DataTable({
      "responsive": true,
      // paging: false 
     // "scrollX": true,
       "dom": 'Blfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Progamación para Pedidos',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default',
        'exportOptions':
        {
          columns:[1,2,3]
        },
        customize: function( xlsx ) {
              var sheet = xlsx.xl.worksheets['sheet1.xml'];
              let rels = xlsx.xl.worksheets['sheet1.xml'];
              var clR = $('row', sheet); 
              
              let nRows = clR.length;//6
              let total = $('c[r=F'+nRows+'] t', sheet).text();                
              $('row:last c t', sheet).text( '' );
              $('c[r=B'+nRows+'] t', sheet).text('TOTAL GALONES:' );
              $('c[r=B'+nRows+'] t', sheet).attr('s','37');
              $('c[r=C'+nRows+'] t', sheet).text( total );
              $('c[r=C'+nRows+'] t', sheet).attr('s','37');             
            },
        'footer': true
      }],

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2); 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                pageTotal
                // +' (S/.'+ total +' total)'
            );
      }
    });
});
 

function validateDates() {

  let $filter_proveedor = $('#filter-proveedor');
  let $tabla_traslado_galones = $('#tabla-traslado-galones');
  inicializarSelect2($filter_proveedor, 'Ingrese el proveedor', '');

  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      let proveedor = $filter_proveedor.find('option:selected').text();
      let cell = data[2];
      if (proveedor) {
        return proveedor === cell;
      }
      return true;
    }
  );

  $filter_proveedor.on('change', function () {
    $tabla_traslado_galones.DataTable().draw();
  });

  $('#fecha_inicio').datepicker();
  $('#fecha_fin').datepicker();
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
    $tabla_traslado_galones.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $tabla_traslado_galones.DataTable().draw();
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
$(document).ready(function() {
  validateDates();
});


</script>
@endsection