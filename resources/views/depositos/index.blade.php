@extends('layouts.main')

@section('title','Ingresos y Egresos')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ingresos</a></li>
  <li><a href="#">Egresos</a></li>
  <li><a href="#">Depositos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('depositos.header') 
  @include('depositos.create') 
  @include('depositos.table')
  
 

</section>
@endsection
