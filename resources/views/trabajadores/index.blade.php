@extends('layouts.main')

@section('title','Trabajadores')

@section('styles')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Trabajadores</a></li>
  <li><a href="#">Gestion</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('trabajadores.create')
  @include('trabajadores.table')
  <!--modales-->
  @include('trabajadores.show')
  @include('trabajadores.edit')
  @include('user.create')
  <!--/.end-modales-->
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/usuarios/user.js') }}"></script>    
@endsection