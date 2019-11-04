@extends('layouts.main')

@section('title','Empresa')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Empresa</a></li>
  <li><a href="#">Información</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('empresa.show_empresa')
<!--   modales -->
	@include('empresa.modal_add')
<!--   end.modales -->
</section>
@endsection

@section('scripts')
<script>
// $(document).ready(function() {
// 	$('#update_stock').submit(function(e){
// 		e.preventDefault();
// 	});
// });
</script>
@endsection
