@extends('layouts.main')

@section('title','Empresa')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Banco</a></li>
  <li><a href="#">Cuentas</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('empresa.bancos.header')
  <div class="container-fluid">
  	@include('empresa.bancos.contenido')
  </div>
	
</section>
@endsection
