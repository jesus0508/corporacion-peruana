@extends('layouts.main')
@section('title','Ingresos')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Grifos</a></li>
  <li><a href="#">Ingresos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('ingresos.table')
  @include('ingresos.create')
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/ingresoGrifos/ingresoGrifos.js') }}"></script>
@endsection