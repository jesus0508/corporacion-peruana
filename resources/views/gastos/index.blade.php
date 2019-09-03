@extends('layouts.main')

@section('title','Gastos')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

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

<!--  modales -->
  @include('gastos.modales.modal_add_categoria')
  @include('gastos.modales.modal_edit_categoria')
  @include('gastos.modales.modal_add_subcategoria')
  @include('gastos.modales.modal_edit_subcategoria')

<!-- modales -end -->
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
	$(document).ready(function() {
    //modal ADD CATEGORIA
    $('#modal-add-categoria').on('show.bs.modal', function (event) {    
      let cod= $(event.relatedTarget).data('cod');      
      $(event.currentTarget).find('#codigo-add').val(cod);
    });

    $('#modal-edit-categoria').on('show.bs.modal', function (event) {    
      let cod= $('#cod_categoria_edit').val();
      $.ajax({
          type: 'GET',
          url:`./categoria_gastos/${cod}`,
          dataType : 'json',

          success: (data)=>{
            $(event.currentTarget).find('#codigo-edit').val(data.codigo);
            $(event.currentTarget).find('#categoria-edit').val(data.categoria);
            $(event.currentTarget).find('#id-edit').val(data.id);
          },
          error: (error)=>{
            toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
          }
      });
    });


    //inicializar SELECT
    $("#categoria").select2({
      placeholder: "Elija un transportista",
      allowClear:true
    });

      let cod = $('#categoria').val();
      let id_delete = cod; 
      if( cod == null){
        $('#cod_right').val('');
        $('#btn_categoria_delete').attr("disabled", true); 
        $('#btn_categoria_edit').attr("disabled", true);      
      } else{
          cod =cod.toString();
          cod= cod.padEnd(3, "0"); 
          $('#cod_categoria_edit').val(cod);
          $('#cod_right').val(cod);
          $('#btn_categoria_delete').attr("disabled", false); 
          $('#btn_categoria_edit').attr("disabled", false);            
      }  

    $('#categoria').on('change', function (event) {    
      let cod = $('#categoria').val();
      let id_delete = cod; 
      if( cod == null){
        $('#cod_right').val('');
        $('#btn_categoria_delete').attr("disabled", true); 
        $('#btn_categoria_edit').attr("disabled", true);      
      } else{
          cod =cod.toString();
          cod= cod.padEnd(3, "0"); 
          $('#cod_categoria_edit').val(cod);
          $('#cod_right').val(cod);
          $('#btn_categoria_delete').attr("disabled", false); 
          $('#btn_categoria_edit').attr("disabled", false);            
      }        
    });
  $('#tabla-gastos').DataTable({
    'language': {
             'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        },
              "order": [[ 0, "desc" ]]
  });
} );
</script>    
@endsection