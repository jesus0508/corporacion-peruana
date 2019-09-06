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

  @include('gastos.registro.register')
  <br>
  @include('gastos.registro.table')

  <!--/.end-modales-->
</section>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
  $(document).ready(function() {

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
function categoria_rellenado(){
  let cod = $('#categoria').val();
  let categoria_gasto_id = cod;
      if( !cod || cod == null){
        $('#subcategoria').empty();
        $('#btn_register').attr("disabled", true);  
      } else{
          //rellenado dinamico de SUBCATEGORIA
            $.get('../subcategorias',{categoria_gasto_id :categoria_gasto_id},
              function(subcategorias){  
               $('#btn_register').attr("disabled", true);             
                $('#subcategoria').empty();
                $('#subcategoria').append("<option value=''>Seleccione una carrera</option>");
            }).done(function(subcategorias) {              
                $.each(subcategorias, function(index,value){
                  $('#subcategoria').append("<option value='"+index+"'>"+value+"</option>"); 
                });
            }).fail(function(){
              $('#subcategoria').empty();
               $('#btn_register').attr("disabled", true); 
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
      if(  cod == null){
          $('#subcategoria').empty();
          $('#codigo_gasto').val('');
          $('#btn_register').attr("disabled", true); 
      } else{
 
          $.get('../conceptos',{subcategoria_gasto_id :subcategoria_gasto_id},
              function(conceptos){
               // console.log(conceptos);
                $('#concepto').empty();
                $('#concepto').append("<option value=''>Seleccione una opcion</option>");
                $('#btn_register').attr("disabled", true);
            }).done(function(conceptos) {              
                $.each(conceptos, function(index,value){
                  $('#concepto').append("<option value='"+index+"'>"+value+"</option>"); 
                });
            }).fail(function(){
              $('#concepto').empty(); 
              $('#btn_register').attr("disabled", true);
              $('#codigo_gasto').val(''); 
              });

        }  
}
   function concepto_rellenado(){
    let cod = $('#concepto').val();
    console.log(cod);
      if( !cod || cod == null){ 
        $('#concepto').empty();
        $('#codigo_gasto').val('');
        $('#btn_register').attr("disabled", true);                 
      } else{
        $.ajax({
            type: 'GET',
            url:`../concepto_gastos/${cod}`,
            dataType : 'json',
            success: (data)=>{
              $('#codigo_gasto').val(data.codigo);
              $('#btn_register').attr("disabled", false);        
            },
            error: (error)=>{
              toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
           }
          });        
      } 
   } 


 $('#categoria').on('change', function (event) {    
      categoria_rellenado();       
  });
 $('#subcategoria').on('change', function (event) {    
      subcategoria_rellenado();            
  });

  $('#concepto').on('change', function (event) {    
      concepto_rellenado();       
  });



  $('#tabla-gastos-registro').DataTable({
    'language': {
             'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        },
              "order": [[ 0, "desc" ]]
  });
} );
</script>    
@endsection