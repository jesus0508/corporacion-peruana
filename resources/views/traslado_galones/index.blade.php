@extends('layouts.main')

@section('title','Traspaso')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet"></link>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Registro </a></li>
</ol>
@endsection


@section('content')
<section class="content">
  @include('traslado_galones.create')
  @include('traslado_galones.table')
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script>
$(document).ready(function() {
  let $input_user_edit = $('#input-user-edit');

  $input_user_edit.on('keyup', function (event) {
  console.log('aea');
  let $cantidad = Number($('#cantidad').val());
  let $stock = Number($('#stock').val());
  let $stock_resultante=$stock+$cantidad;
  $('#nuevo_stock').val($stock_resultante);

  });
	  $('#tabla-traslado-galones').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "responsive": false, 
      "scrollX": true,
    });
});
</script>
@endsection
