@extends('layouts.main')

@section('title','Grifos')

@section('styles')
{{-- select2 4.0.8 --}}
<link rel="stylesheet" href="{{asset('dist/css/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Grifos</a></li>
  <li><a href="#">Gestion</a></li>
  <li><a href="#">Asignación serie</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('grifos.series.asignacion.header')
  @include('grifos.series.asignacion.body')
    <!-- modal new serie -->
  @include('grifos.series.modal_new_serie')
</section>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/select2/select2.min.js') }}"></script>
<script>
	$('#serie_multi').prop('selectedIndex', -1);
	$('#serie_multi').select2({
		placeholder: 'Seleccione las series que desea',
		allowClear: true
		});
	

</script>    
@endsection