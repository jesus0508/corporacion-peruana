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
	<div class="row">
		<div class="col-md-12">

		</div>
		
	</div>
	<br>
  @include('gastos.create_categoria')
  @include('gastos.create_subcategoria')
  @include('gastos.create_gasto')
  @include('gastos.table')
  <!--modales-->
  @include('gastos.edit')
  <!--/.end-modales-->
</section>
@endsection

@section('scripts')
<script>
	$(document).ready(function() {
 

  $('#tabla-gastos').DataTable({
    'language': {
             'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        },
              "order": [[ 0, "desc" ]]
  });
} );
</script>    
@endsection