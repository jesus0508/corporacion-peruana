@extends('layouts.main')
@section('title','Ingresos')
@section('styles')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ingresos</a></li>
  <li><a href="#">Categorias Ingreso</a></li>

</ol>
@endsection

@section('content')
<section class="content">
  @include('ingresos_otros.categorias.header') 
  @include('ingresos_otros.categorias.table')

</section>
@endsection
