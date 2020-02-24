@extends('layouts.main')
@section('title','Ingresos')
@section('styles')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ingresos</a></li>
  <li><a href="#">Categorias Ingreso</a></li>

</ol>
@endsection

@section('content')
<section class="content">
  @include('salidas.categorias.header') 
  @include('salidas.categorias.table')
	@include('salidas.categorias.edit')
</section>
@endsection

@section('scripts')
<script>
	$('#modal-edit-categoria').on('show.bs.modal',function(event){
		let id        =  $(event.relatedTarget).data('id');
		let categoria =  $(event.relatedTarget).data('categoria');
    $(event.currentTarget).find('#id-edit').val(id); 
    $(event.currentTarget).find('#categoria').val(categoria); 
  });

</script>
@endsection
