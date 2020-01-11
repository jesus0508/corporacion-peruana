@extends('layouts.main')
@section('title','Movimientos')
@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="#">Movimentos</a></li>
</ol>
@endsection

@section('content')

<section class="content">
  @include('movimientos.table')
</section>

{{--  modales  --}}
	@include('movimientos.create')
	@include('movimientos.modal_edit')
 {{-- end modal --}}

@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script src="{{ asset('js/movimientos/movimientos.js') }}"></script>
@endsection