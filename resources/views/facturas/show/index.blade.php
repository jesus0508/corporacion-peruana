@extends('layouts.main')

@section('title','Clientes')


@section('styles')
{{-- <link src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css"></link> 
<link src="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css"></link>  --}}
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet"></link>
<style type="text/css">
#div-tabla-export-factura {
display: none;
}
</style>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Facturas</a></li>
  <li><a href="#">Pedidos</a></li>
  <li><a href="#">Resumen</a></li>
 
</ol>
@endsection

@section('content')
<section class="content">
    @include( 'facturas.show.header')
    <div class="row">
      <!-- left column -->      
      <div class="col-md-8">
      @include('facturas.Ind.datos_pedido_proveedor')
      @includeWhen($pedido->factura_proveedor_id != null ,'facturas.show.form_factura')
      @include('facturas.show.form_transportista')
      </div><!--/.col (left) -->
      @include('facturas.show.detalles_pedido')<!--/.col (right) -->
    </div> <!-- /.row-top -->
    @include('facturas.show.table_export')

 
</section>
@endsection
@section('scripts')
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script>
$(document).ready(function() {

  $('#export_factura_table').on('click', function () {
    //console.log("click");
    document.getElementById("excelButton").click();
  });

  $('#factura-export').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "responsive": false, 
      "searching": false,
      "paging": false,
      "info" : false,
      "scrollX": true,
      "dom": 'Bfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Datos Pedido - Factura',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default button-export-factura',
        'exportOptions':
        {
          columns:[0,1,2,3,4,5,6,7,8,9]
        }
      }], 
      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            //getSubtotal(api,10);
      }
  });
});

$(document).ready(function() {

    var monto=$("#monto_factura").val();
    var total=$("#total").val();
    if(monto>0 && total>0){
      var diferencia = monto-total;
     // Math.round(diferencia*100)/100;
      diferencia = parseFloat(diferencia).toFixed(2);
      
      
      if( diferencia > 0 ){
        var dif = document.getElementById('diferencia');
          dif.style.backgroundColor = "#e53935";
          dif.style.color = "black";
       }else if( diferencia == 0 ) {
          var dif = document.getElementById('diferencia');
          dif.style.backgroundColor = "#eee";
          dif.style.color = "#555";
          }
       else{
          var dif = document.getElementById('diferencia');
          dif.style.backgroundColor = "#4caf50";
          dif.style.color = "black";

       }


      $('#diferencia').val(diferencia);
    }  

});
</script>


@endsection
