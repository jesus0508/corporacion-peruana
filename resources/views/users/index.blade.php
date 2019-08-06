@extends('layouts.main')

@section('title','Usuarios')

@section('styles')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Usuarios</a></li>
  <li><a href="#">Gestion</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('users.create')
  @include('users.table')
  <!--modales-->
  @include('users.show')
  @include('users.edit')
  <!--/.end-modales-->
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/user.js') }}"></script>    
@endsection