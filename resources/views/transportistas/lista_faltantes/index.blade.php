@extends('layouts.main')

@section('title','Transportistas')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
$(document).ready(function() {
  
    $('#tabla-flete-faltantes').DataTable({  
          "ordering": false,    
        "responsive": true,             
        'language': {
        'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
      }   
    });
});
</script>
@endsection
