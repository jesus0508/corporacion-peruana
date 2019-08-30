@extends('layouts.main')

@section('title','Transportistas')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
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
			IR A TRANSPORTISTAS
			&nbsp; <span class="fa fa-list"></span>
			</button>
    </a>   	
    <p> </br></p>
</section>
<section class="content">
  @include('transportistas.create')
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script type="text/javascript" src="{{ asset('js/transportista.js') }}"></script> 

<script>


</script>  
@endsection