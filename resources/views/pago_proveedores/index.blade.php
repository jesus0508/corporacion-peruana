@extends('layouts.main')
@section('title','Pagos')
@section('styles')
{{-- select2 4.0.8 --}}
<link rel="stylesheet" href="{{asset('dist/css/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="#">Pagos</a></li>
</ol>
@endsection

@section('content')
  @include('pago_proveedores.header')
<section class="content">
  <form class="" action="{{route('pago_proveedors.store')}}" method="post">
    @csrf
    @include('pago_proveedores.create')
    @include('pago_proveedores.table')
  </form>
</section>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/select2/select2.min.js') }}"></script>
<script>
$(document).ready(function() {


var fixHelperModified = function(e, tr) {
    var $originals = tr.children();
    var $helper = tr.clone();
    $helper.children().each(function(index) {
        $(this).width($originals.eq(index).width())
    });
    return $helper;
},
    updateIndex = function(e, ui) {
        $('td.index', ui.item.parent()).each(function (i) {
            $(this).html(i + 1);
        });
    };

$("#pago_proveedores_lista tbody").sortable({
    helper: fixHelperModified,
    stop: updateIndex
}).disableSelection();



  // $('#pago_proveedores_lista').DataTable({
  //     "responsive": true,
  //     "dom": 'Bfrtip',
  //     "buttons": [
  //       {
  //         extend: 'excelHtml5',
  //         title: 'Lista Pagos Transportista',
  //         attr:  {
  //               title: 'Excel',
  //               id: 'excelButton'
  //           },
  //         text:     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
  //         className: 'btn btn-default',
  //         exportOptions:
  //           {
  //             columns:[0,1,2,3,4,5,6,7]
  //           }

  //        }
  //       ],
  //   });

	$('#banco').prop('selectedIndex', -1);
    $('#banco').select2({
 		allowClear: true,
 		placeholder: "Elija el Banco de la transacción."
 });
});
$('#fecha_factura').datepicker();
$('#fecha_reporte').datepicker();

</script>

@endsection