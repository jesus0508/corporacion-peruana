@extends('layouts.main')

@section('title','Empresa')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Empresa</a></li>
  <li><a href="#">Información</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('empresa.show_empresa')
</section>
@endsection
