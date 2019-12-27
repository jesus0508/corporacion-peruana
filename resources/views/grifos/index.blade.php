@extends('layouts.main')

@section('title','Grifos')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Grifos</a></li>
  <li><a href="#">Gestion</a></li>
</ol>
@endsection

@section('content')
<section class="content">
	@include('grifos.header')
  @include('grifos.create')
  @include('grifos.table')
  <!--modales-->
  @include('grifos.show')
  @include('grifos.edit')
  @include('grifos.series.modal_new_serie')
  <!--/.end-modales-->
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/grifos/grifos.js') }}"></script>    
@endsection