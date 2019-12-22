@extends('layouts.main')

@section('title','Venta')
@section('styles')
<link src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css"></link> 
<link src="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css"></link> 
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet"></link>
{{-- <style type="text/css">
#excelButton{
display: none;
}
</style> --}}
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
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script>
$(document).ready(function() {

  $('#export_distribucion_table').on('click', function () {
   //console.log("click");
    document.getElementById("excelButton").click();
  });


  $('#tabla-pedido-clientes-grifos-asignacion').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
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


