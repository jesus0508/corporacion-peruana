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
			<div class="pull-left">
         		<a href="#collapseCategoria" class="btn btn-primary" data-toggle="collapse" aria-expanded="false" aria-controls="collapseCategoria">
          			<span class="fa fa-plus"> </span>&nbsp;
         		 Agregar Categoria
        		</a>
         		<a href="#collapseSubCategoria" class="btn btn-primary" data-toggle="collapse" aria-expanded="false" aria-controls="collapseSubCategoria">
          			<span class="fa fa-plus"> </span>&nbsp;
         		 Agregar SubCategoria
        		</a>
         		<a href="#collapseGasto" class="btn btn-primary" data-toggle="collapse" aria-expanded="false" aria-controls="collapseGasto">
          			<span class="fa fa-plus"> </span>&nbsp;
         		 Agregar Gasto
        		</a>
			</div>		
		</div>
		
	</div>
	<br>
  @include('gastos.create')
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