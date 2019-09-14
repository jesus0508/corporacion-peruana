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


<!--  modales -->
  @include('gastos.modales.modal_add_categoria')
  @include('gastos.modales.modal_edit_categoria')
  @include('gastos.modales.modal_add_subcategoria')
  @include('gastos.modales.modal_edit_subcategoria')
  @include('gastos.modales.modal_add_concepto')
  @include('gastos.modales.modal_edit_concepto')
<!-- modales -end -->
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
  
$(document).ready(function() {
        //btn_add_subcat
  $('#btn_add_subcat').on('click', function(e){//store subcat
    let categoria_gasto_id = $('#id_cat-add').val();
    let subcategoria = $('#subcategoria_aea').val();
    let codigo = $('#codigo_new_subcat').val();       
    let token =$('#token_add').val();
    e.preventDefault(e);
        //console.log('aea qui toy');
    $.ajax({
        url: `sub_categoria_gastos`,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{
          categoria_gasto_id: categoria_gasto_id,
          subcategoria: subcategoria,
          codigo: codigo
        }

    }).done(function (data){     
      $('#modal-add-subcategoria').modal('hide'); 
        categoria_rellenado();   
        toastr.success(data.status, 'Subcategoria registrado con éxito', { timeOut: 2000 });
    }).fail(function() {
        toastr.error(data.status, 'Subcategoria no registrado con éxito', { timeOut: 2000 });
    });    
  });

  $('#btn_add_concepto').on('click', function(e){//store concepto
    let sub_categoria_gasto_id = $('#id_subcat-add').val();
    let concepto = $('#concepto_aea').val();
    let codigo = $('#codigo_new_concepto').val();       
    let token =$('#token_add_concepto').val(); 
    e.preventDefault(e); 
   // console.log(token);      
    $.ajax({
        url: `concepto_gastos`,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{
          sub_categoria_gasto_id: sub_categoria_gasto_id,
          concepto: concepto,
          codigo: codigo
        }

    }).done(function (data){     
      $('#modal-add-concepto').modal('hide'); 
       subcategoria_rellenado();   
       toastr.success(data.status, 'Gasto registrado con éxito', { timeOut: 2000 });
    });    
  });

    $("#categoria").select2({
     placeholder: "Elija una categoría",
     allowClear:true
    });

    $("#subcategoria").select2({
      placeholder: "Elija un unasubcateogria",
      allowClear:true
    });

    $("#concepto").select2({
      placeholder: "Elija un gasto  ",
      allowClear:true
    });
    categoria_rellenado();     
    subcategoria_rellenado();  
    concepto_rellenado();
    //modal ADD CATEGORIA
    $('#modal-add-categoria').on('show.bs.modal', function (event) {    
      let cod= $(event.relatedTarget).data('cod');      
      $(event.currentTarget).find('#codigo-add').val(cod);
    });
     //modal ADD SUBCATEGORIA   
    $('#modal-add-subcategoria').on('show.bs.modal', function (event) {
      let cod = $('#categoria').val();
      let codigo = $('#cod_categoria_edit').val();
      let codigo_new    = $(event.relatedTarget).data('cod'); 
      // $(event.currentTarget).find('#codigo-add').val(codigo_new);
      //console.log('holi');
       $.ajax({
          type: 'GET',
          url:`./categoria_gastos/${codigo}`,
          dataType : 'json',
          success: (data)=>{
           $(event.currentTarget).find('#id_cat-add').val(data.id);
           $(event.currentTarget).find('#codigo_new_subcat').val(data.id*100+1+data.sub_categoria_gastos.length);
            document.getElementById('categoria_val').innerHTML = data.categoria ;
          },
          error: (error)=>{
            toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
          }
      });

    });

    $('#modal-add-concepto').on('show.bs.modal', function (event) {
      let cod = $('#subcategoria').val();//id
     // let codigo= $('#cod_sub_categoria_edit').val();
      let cod_subcat = $('#cod_subcat_right').val();
       $.ajax({
          type: 'GET',
          url:`./sub_categoria_gastos/${cod}`,
          dataType : 'json',
          success: (data)=>{
           $(event.currentTarget).find('#id_subcat-add').val(data.id);
           $(event.currentTarget).find('#codigo_new_concepto').val(cod_subcat*1000+1+data.concepto_gastos.length);
            document.getElementById('subcategoria_val').innerHTML = data.subcategoria ;
          },
          error: (error)=>{
            toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
          }
      });

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

    $('#modal-edit-subcategoria').on('show.bs.modal', function (event) {    
      let cod= $('#cod_subcategoria_edit').val();//el id de la subcategoria
      $.ajax({
          type: 'GET',
          url:`./sub_categoria_gastos/${cod}`,
          dataType : 'json',

          success: (data)=>{
           // console.log(data);
            $(event.currentTarget).find('#codigo-edit').val(data.codigo);
            $(event.currentTarget).find('#subcategoria-edit').val(data.subcategoria);
            $(event.currentTarget).find('#id-edit').val(data.id);
          },
          error: (error)=>{
            toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
          }
      });
    });
    $('#modal-edit-concepto').on('show.bs.modal', function (event) {    
      let cod= $('#cod_concepto_edit').val();//el id
      $.ajax({
          type: 'GET',
          url:`./concepto_gastos/${cod}`,
          dataType : 'json',

          success: (data)=>{
           // console.log(data);
            $(event.currentTarget).find('#codigo-edit').val(data.codigo);
            $(event.currentTarget).find('#concepto-edit').val(data.concepto);
            $(event.currentTarget).find('#id-edit').val(data.id);
          },
          error: (error)=>{
            toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
          }
      });
    });




function categoria_rellenado(){
  let cod = $('#categoria').val();
  let categoria_gasto_id = cod;
      if( cod == null){
        $('#cod_cat_right').val('');
        $('#btn_categoria_delete').attr("disabled", true); 
        $('#btn_categoria_edit').attr("disabled", true);
        $('#btn_subcategoria_add').attr("disabled", true);
        $('#btn_subcategoria_delete').attr("disabled", true); 
        $('#btn_subcategoria_edit').attr("disabled", true); 
        $('#subcategoria').empty();
        $('#cod_subcat_right').val('');    
 
      } else{
          cod =cod.toString();
          cod= cod.padEnd(3, "0"); 
          $('#cod_categoria_edit').val(cod);
          $('#cod_cat_right').val(cod);
          $('#btn_categoria_delete').attr("disabled", false); 
          $('#btn_categoria_edit').attr("disabled", false);
          $('#btn_subcategoria_add').attr("disabled", false);
          //rellenado dinamico de SUBCATEGORIA
            $.get('subcategorias',{categoria_gasto_id :categoria_gasto_id},
              function(subcategorias){
               // ordenarDesc(subcategorias, 'id'); 
             //   console.log( subcategorias.reverse() );               
                $('#subcategoria').empty();
                $('#subcategoria').append("<option value=''>Seleccione una carrera</option>");
            }).done(function(subcategorias) {              
                $.each(subcategorias, function(index,value){
                  $('#subcategoria').append("<option value='"+index+"'>"+value+"</option>"); 
                });
            }).fail(function(){
              $('#subcategoria').empty();
              $('#cod_subcat_right').val(''); 
              });
      }  
}

function subcategoria_rellenado(){
  let cod_cat = $('#categoria').val();
  let id_cat =cod_cat;
  let cod = $('#subcategoria').val(); 
  //$('#subcategoria').val(cod).trigger('change'); 
  let subcategoria_gasto_id = cod;
  //console.log(id_cat);
      if( !cod || cod == null){
        $('#cod_subcat_right').val('');
        $('#btn_subcategoria_delete').attr("disabled", true); 
        $('#btn_subcategoria_edit').attr("disabled", true);   
        $('#btn_concepto_add').attr("disabled", true);  


      } else{
 
          $.ajax({
            type: 'GET',
            url:`./sub_categoria_gastos/${cod}`,
            dataType : 'json',
            success: (data)=>{              
              if( data.concepto_gastos.length > 0 ){
                $('#btn_subcategoria_delete').attr("disabled", true);
                } 
              $('#cod_subcategoria_edit').val(cod);
              $('#id_subcategoria_delete').val(cod);
              $('#cod_subcat_right').val(data.codigo);        
              $('#btn_subcategoria_delete').attr("disabled", false); 
              $('#btn_subcategoria_edit').attr("disabled", false); 
              $('#btn_concepto_add').attr("disabled", false);        
            },
            error: (error)=>{
              toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
            }
          });
          $.get('conceptos',{subcategoria_gasto_id :subcategoria_gasto_id},
              function(conceptos){
               // console.log(conceptos);
                $('#concepto').empty();
                $('#concepto').append("<option value=''>Seleccione una opcion</option>");
            }).done(function(conceptos) {              
                $.each(conceptos, function(index,value){
                  $('#concepto').append("<option value='"+index+"'>"+value+"</option>"); 
                });
            }).fail(function(){
              $('#concepto').empty();
              $('#cod_concepto_right').val(''); 
              });

        }  
}
   function concepto_rellenado(){
    let cod = $('#concepto').val();
      if( !cod || cod == null){
        $('#btn_concepto_delete').attr("disabled", true); 
        $('#btn_concepto_edit').attr("disabled", true); 
        $('#concepto').empty();
        $('#cod_concepto_right').val(''); 
      } else{
        $.ajax({
            type: 'GET',
            url:`./concepto_gastos/${cod}`,
            dataType : 'json',
            success: (data)=>{
              $('#cod_concepto_edit').val(cod);
              $('#id_concepto_delete').val(cod);
              $('#cod_concepto_right').val(data.codigo);
              $('#btn_concepto_delete').attr("disabled", false); 
              $('#btn_concepto_edit').attr("disabled", false);          
            },
            error: (error)=>{
              toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
           }
          });        
      } 
   } 

 


  $('#subcategoria').on('change', function (event) {    
      subcategoria_rellenado();            
  });

   // categoria_rellenado();     
  $('#categoria').on('change', function (event) {    
      categoria_rellenado();       
  });

  $('#concepto').on('change', function (event) {    
      concepto_rellenado();       
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