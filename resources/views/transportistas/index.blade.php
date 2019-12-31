@extends('layouts.main')

@section('title','Transportistas')
@section('styles')
{{-- select2 4.0.8 --}}
<link rel="stylesheet" href="{{asset('dist/css/select2/select2.min.css')}}">
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
  @include('transportistas.opciones')
</section>
<section class="content">
  @include('transportistas.table')
  <!--modales-->
  @include('transportistas.edit')
  <!--/.end-modales-->
</section>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/transportista.js') }}"></script> 
@if( count($errors) > 0 )
  <script type="text/javascript">
      $('#modal-edit-transportista').modal('show');
  </script>
@endif  
@endsection