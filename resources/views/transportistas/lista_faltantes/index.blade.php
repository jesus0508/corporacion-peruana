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
  <li><a href="#">Flete Pedidos</a></li>
  <li><a href="#"> Faltante Lista</a></li>
</ol>
@endsection

@section('content')

<section class="content">
	@include('transportistas.lista_faltantes.opciones')
    @include('transportistas.lista_faltantes.table')
</section>

@endsection

@section('scripts')
<script src="{{ asset('dist/js/select2/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
  
    $('#tabla-flete-faltantes').DataTable({  
        "ordering": false,    
        "responsive": true            
    });
});
</script>
@endsection
