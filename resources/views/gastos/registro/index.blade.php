@extends('layouts.main')

@section('title','Gastos')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Gastos</a></li>
  <li><a href="#">Gestion</a></li>
</ol>
@endsection

@section('content')
<section class="content">

  @include('gastos.registro.register')
  <br>
  @include('gastos.registro.table')

  <!--/.end-modales-->
</section>
@endsection

@section('scripts')
<script>
	$(document).ready(function() {
 

  $('#tabla-gastos-registro').DataTable({
    'language': {
             'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        },
              "order": [[ 0, "desc" ]]
  });
} );
</script>    
@endsection