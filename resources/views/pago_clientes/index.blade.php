@extends('layouts.main')
@section('title','Pagos')
@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="#">Pagos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('pago_clientes.table')
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script src="{{ asset('js/pagoClientes/pagos.js') }}"></script>
<script src="{{ asset('js/pagoClientes/filtradoFecha.js') }}"></script>
<script>

 let $tabla_pagos = $('#tabla-pagos');
  $tabla_pagos.DataTable({
      "dom": 'Blfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Pagos de Clientes',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default button-export-factura',
        'exportOptions':
        {
          columns:[1,2,3,4,5,6]
        }
      }]
  });

</script>
@endsection