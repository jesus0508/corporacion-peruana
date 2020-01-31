@extends('layouts.main')

@section('title','Pedidos')

@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="#">Ver Pedidos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('pedido_clientes.table')
  @include('pedido_clientes.confirmar_pedido')
  @include('pedido_clientes.facturar_pedido')
  @include('pedido_clientes.show')
  @include('pedido_clientes.edit') 
  @include('pago_clientes.create')
  @include('pago_clientes.bloque')
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script src="{{ asset('js/pedidoClientes/pedidoCliente.js') }}"></script> 
<script src="{{ asset('js/pagoClientes/pagos.js') }}"></script> 
<script>
	function validateDates() {
	 
	  let $tabla_pedido_clientes = $('#tabla-pedido_clientes');

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
	    $tabla_pedido_clientes.DataTable().draw();
	  });

	  $('#clear-fecha').on('click', function () {
	    $('#fecha_inicio').val("");
	    $('#filter-cliente').val('').trigger('change');
	    $tabla_pedido_clientes.DataTable().draw();
	  });
	}

$(document).ready(function() {
  validateDates();
});

</script>
@endsection