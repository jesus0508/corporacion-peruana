@extends('layouts.main')

@section('title','Traspaso')

@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Registro </a></li>
</ol>
@endsection


@section('content')
<section class="content">
 {{--  @include('traslado_galones.reporte.proovedores.create') --}}
  @include('traslado_galones.reportes.proveedores.table')
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>

$(document).ready(function() {

	  $('#tabla-traslado-galones').DataTable({
      "responsive": true, 
     // "scrollX": true,
       "dom": 'Bfrtip',
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
          columns:[1,2,3,4,5,6,7,8]
        }
      }]
    });
});
 

function validateDates() {

  let $tabla_traslado_galones = $('#tabla-traslado-galones');
  $('#fecha_inicio').datepicker();
  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $('#fecha_inicio').val();
      var inicio = $.datepicker.parseDate('d/m/yy', sInicio); 
      var dia = $.datepicker.parseDate('d/m/yy', data[1]);
      if (!inicio || !dia || inicio == dia) {
        return true;
      }
      return false;
    }
  );

  $('#filtrar-fecha').on('click', function () {
    console.log('aea');
    $tabla_traslado_galones.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $tabla_traslado_galones.DataTable().draw();
  });
}
$(document).ready(function() {
  validateDates();
});


</script>
@endsection