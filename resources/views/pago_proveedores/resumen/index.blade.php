@extends('layouts.main')
@section('title','Pagos')
@section('styles')
  @include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="#">Pagos</a></li>
  <li><a href="#">Resumen</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('pago_proveedores.resumen.buttons_top')
  @include('pago_proveedores.resumen.create')
  @include('pago_proveedores.resumen.table')
</section>
@endsection

@section('scripts')
	@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {

$('#table-pago_proveedor-resumen').DataTable({
      "responsive": false, 
      "searching": false,
      "paging": false,
      "ordering": false,
      "info" : false,
      "scrollX": true,
      "columnDefs": [{
        "targets": [ 0,1,2,3,4 ],
        "visible": false
       }],
      "dom": 'Bfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Pago a proveedor - Resumen',
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
              $('c[r=L'+nRows+'] t', sheet).text('Monto Total Pagado:' );
              $('c[r=L'+nRows+'] t', sheet).attr('s','37');
              $('c[r=M'+nRows+'] t', sheet).text( total );
              $('c[r=M'+nRows+'] t', sheet).attr('s','37');             
            },
        'exportOptions':
        {
          columns:[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
        },
        footer: true
      }],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            pageTotal = api
                .column( 12, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);        
            $( api.column( 12 ).footer() ).html(pageTotal);
      }
  });
} );
</script>
@endsection