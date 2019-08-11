@extends('layouts.main')

@section('title','Proveedores')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Proveedores</a></li>
  <li><a href="#">Gestion</a></li>
</ol>
@endsection

@section('content')
<section class="content-header">
    <a href="{{route('proveedores.index')}}">
			<button class="btn btn-primary pull-right">
			IR PROVEEDORES &nbsp; <span class="fa fa-list"></span>
			</button>
    </a>   	
    <p>  </br></p>
</section>
<section class="content">
 @include('proveedores.create')
</section>
<!-- BOTONES EN views/actions/proveedor  -->
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/proveedor.js') }}"></script> 
<script type="text/javascript">
	$("#proveedor").select2();
</script>
@endsection



