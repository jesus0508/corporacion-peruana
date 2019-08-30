@extends('layouts.main')
@section('title','Movimientos')
@section('styles')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
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
@include('movimientos.create')
@endsection

@section('scripts')

<script src="{{ asset('js/movimientos/movimientos.js') }}"></script>
@endsection