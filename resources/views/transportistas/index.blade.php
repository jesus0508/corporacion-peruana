@extends('layouts.main')

@section('title','Transportistas')
@section('styles')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Transportistas</a></li>
  <li><a href="#">Gestion</a></li>
</ol>
@endsection

@section('content')
<section class="content-header">
      <a href="{{ route('transportista.create') }}">
      <button class="btn bg-olive pull-right">
      NUEVO TRANSPORTISTA&nbsp;|&nbsp;VEHÍCULO &nbsp; <span class="fa fa-plus"></span>
      </button>
    </a> 
    <p>  </br></p>

</section>
<section class="content">
  @include('transportistas.table')
  <!--modales-->
  @include('transportistas.edit')
  <!--/.end-modales-->
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script type="text/javascript" src="{{ asset('js/transportista.js') }}"></script> 
@if( count($errors) > 0 )
  <script type="text/javascript">
      $('#modal-edit-transportista').modal('show');

  </script>
@endif  
@endsection