@extends('layouts.main')
@section('title','Pagos')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">

@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="#">Pagos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('pago_proveedores.create')
  @include('pago_proveedores.table')
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<script>
$(document).ready(function() {
  $('#pago_proveedores_lista').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "responsive": true,
      "dom": 'Bfrtip',
      "buttons": [
        {
          extend: 'excelHtml5',
          title: 'Lista Pagos Transportista',
          attr:  {
                title: 'Excel',
                id: 'excelButton'
            },
          text:     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
          className: 'btn btn-default',
          exportOptions:
            {
              columns:[0,1,2,3,4,5,6,7]
            }

         }
        // ,{
        //   extend: 'pdfHtml5',
        //   title: 'Programación Flete Transportistas',
        //   exportOptions:
        //     {
        //       columns:[0,1,2,3,4,5,6]
        //     }
        // }
        ],
    });

	$('#banco').prop('selectedIndex', -1);
    $('#banco').select2({
 		allowClear: true,
 		placeholder: "Elija el Banco de la transacción."
 });
});
//$('#fecha_factura').val($.datepicker.formatDate('dd/mm/yy', new Date()));
$('#fecha_factura').datepicker();
$('#fecha_reporte').datepicker();

</script>

@endsection