@extends('layouts.main')

@section('title','Distribución')
@section('styles')
{{--  datatables buttons 1.5.6 --}}
<link rel="stylesheet" href="{{asset('dist/css/datatables/buttons.dataTables.min.css')}}">
@endsection


@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="#">Pedidos Distribucion</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include( 'distribucion.resumen.buttons_top')
  @include('distribucion.resumen.pedido_proveedor')
 {{--  @include('distribucion.resumen.tabla_pedido_cliente')  --}}
  @includeWhen(isset($pedidos_grifos),'distribucion.resumen.tabla_pedido_cliente_grifo')
</section>
@endsection

@section('scripts')
@include('reporte_excel.export_js')
<script>
$(document).ready(function() {

  $('#export_distribucion_table').on('click', function () {
   //console.log("click");
    document.getElementById("excelButton").click();
  });


  $('#tabla-pedido-clientes-grifos-asignacion').DataTable({
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
        'title': 'Datos Distribución pedido a Grifos - SCOP: '
        +{{$pedido->scop}},
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
              $('c[r=G'+nRows+'] t', sheet).text('Total Galones Distribuidos:' );
              $('c[r=G'+nRows+'] t', sheet).attr('s','37');
              $('c[r=H'+nRows+'] t', sheet).text( total );
              $('c[r=H'+nRows+'] t', sheet).attr('s','37');             
            },
        'exportOptions':
        {
          columns:[0,1,2,3,4,5,6,7,8]
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
} );

</script>
@endsection


