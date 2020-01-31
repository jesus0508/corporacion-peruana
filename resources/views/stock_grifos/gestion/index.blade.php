@extends('layouts.main')

@section('title','Grifos')

@section('styles')
  @include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Stock Grifo</a></li>
  <li><a href="#">Lista stock grifo</a></li>
</ol>
@endsection


@section('content')
<section class="content">
  @include('stock_grifos.gestion.table')
 {{-- @include('transporte.egresos.table') --}} 
  
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {

	$('#tabla-stock-grifos').DataTable({
      "responsive": false, 
      "scrollX": true,
    });
  validateDates();
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
 
  let $tabla_traslado_galones = $('#tabla-stock-grifos');

  $('#fecha_inicio').datepicker();
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
    $tabla_traslado_galones.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $('#filter-grifo').val('').trigger('change');
    $tabla_traslado_galones.DataTable().draw();
  });
}
$(document).ready(function() {
  validateDates();
    let $filter_grifo = $('#filter-grifo');
    let $tabla_egresos_grifo = $('#tabla-stock-grifos');
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
</script>
@endsection
