@extends('layouts.main')

@section('title','Grifos')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Grifos</a></li>
  <li><a href="#">Gestion</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('grifos.create')
  @include('grifos.table')
  <!--modales-->
  @include('grifos.show')
  @include('grifos.edit')
  <!--/.end-modales-->
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/grifos/grifos.js') }}"></script>    
@endsection