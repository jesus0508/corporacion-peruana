@extends('layouts.main')
@section('title','Pedidos')
@section('styles')
  @include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{route('pedidos.index')}}">Pedidos</a></li>
  <li><a href="#">Historial Pago Pedido</a></li>
</ol>
@endsection

@section('content')

<section class="content">
  @include('pedidosP.partials.opciones_show_pagos')
	@include('pedidosP.show_pagos.detalles_pedido')
  @include('pedidosP.show_pagos.table')
</section>

@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script src="{{ asset('js/pedidos.js') }}"></script>
<script>
$(document).ready(function() {
	$('#resumen-historial-pago-pedido').DataTable({
	      "responsive": false, 
	      "searching": false,
	      "paging": false,
	      "ordering": false,
	      "info" : false,
	      "scrollX": true,
	      "dom": 'Bfrtip',
	      "buttons": [
	      {
	        'extend': 'excelHtml5',
	        'title': 'HISTORIAL de PAGO de PEDIDO-PROVEEDOR',
	        'attr':  {
	          title: 'Excel',
	          id: 'excelButton'
	        },
	        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
	        'className': 'btn btn-default button-export-factura',
	        customize: function( xlsx ) {
	              var sheet = xlsx.xl.worksheets['sheet1.xml'];
	              let rels = xlsx.xl.worksheets['sheet1.xml'];
	              var clR = $('row', sheet); 
	              
	              let nRows = clR.length;//6
	              let total = $('c[r=F'+nRows+'] t', sheet).text();                
	              $('row:last c t', sheet).text( '' );
	              $('c[r=E'+nRows+'] t', sheet).text('Monto Total Pagado:' );
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
	      }
	  });
	} );
</script>
@endsection