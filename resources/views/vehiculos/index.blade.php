@extends('layouts.main')

@section('title','Transportistas')
@section('styles')

<link rel="stylesheet" href="{{asset('css/app.css')}}">

@endsection
@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Transportistas</a></li>
  <li><a href="#">Gestion</a></li>
</ol>
@endsection

@section('content')
<section class="content-header">

	    <a href="{{route('transportista.index')}}">
			<button class="btn bg-olive pull-right">
			VOLVER TRANSPORTISTAS &nbsp; <span class="fa fa-reply"></span>
			</button>
    </a>   
  <h3>Vehículos de <span class="label label-primary">{{$transportista->nombre_transportista}}</span>:</h3>

</section>
<section class="content">

  @include('vehiculos.table')
  <!--modales-->
  @include('vehiculos.edit')
  <!--/.end-modales-->
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/vehiculo.js') }}"></script>  
@endsection