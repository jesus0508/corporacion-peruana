@extends('layouts.main')

@section('title','Plantas')
@section('styles')

<link rel="stylesheet" href="{{asset('css/app.css')}}">

@endsection
@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ route('proveedores.index') }}">Proveedores</a></li>
  <li><a href="{{ route('proveedores.create') }}">Registro</a></li>
  
</ol>
@endsection

@section('content')
<section class="content-header">
	    <a href="{{route('proveedores.index')}}">
			<button class="btn bg-olive pull-right">
			VOLVER PROVEEDORES &nbsp; <span class="fa fa-reply"></span>
			</button>
    </a> 
  	<h3>&nbsp;&nbsp;Plantas de  
  	  <span class="label label-primary">{{$proveedor->razon_social}}</span>:

    </h3>

</section>
<section class="content">
  @include('proveedores.planta.show')
</section>
@endsection
