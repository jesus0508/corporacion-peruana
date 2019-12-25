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
      <div class="pull-right ">
        <a  class="btn btn-success"
         href="http://localhost/C/corporacion-peruana/public/egresos_listado">
          <i class="fa fa-list"></i> 
            Lista Gastos Grifos
        </a>
      </div>
    </div>
  </div>
  <p></p>  
  @include('gastos.registro2.register')
  <!--/.end-modales-->
</section>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
$(document).ready(function() {

  function  inicializarSelect(id, text){
    $("#"+id).prop({
    selectedIndex: -1
    });
    $("#"+id).select2({
       placeholder: text,
       allowClear:true
      });
  }

  inicializarSelect('grifo_id','Escoga un grifo');
  inicializarSelect('concepto_name','Escoga un gasto');
  inicializarSelect('concepto_id','Escoga un gasto');

  $('input[type=radio][name=opcion]').change(function() {    
      inicializarSelect('concepto_name','Escoga un gasto');
      inicializarSelect('concepto_id','Escoga un gasto');
      $('#categoria_gasto').val('');
      $('#subcategoria_gasto').val(''); 
  });
  $('#fecha_egreso').datepicker();
  $('#fecha_reporte').datepicker();
  $(document.body).on("change","#concepto_name",function(){
      let opcion = $('input[name=opcion]:checked').val(); 
      if(opcion == 2){//cambio por concepto
        let id = this.value;
        $('#concepto_id').val(id).trigger('change');
        if( !id || id == null || id == ''){ 
          $('#categoria_gasto').val('');
          $('#subcategoria_gasto').val('');                  
        } else{
            console.log(id);
            $.ajax({
              type: 'GET',
              url:`../concepto_gastos/${id}/edit`,
              dataType : 'json',
              success: (data)=>{
                $('#categoria_gasto').val(data.categoria);
                $('#subcategoria_gasto').val(data.subcategoria); 
                console.log(data);     
              },
              error: (error)=>{
                toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
              }
            });
        }
      }  
  });

  $(document.body).on("change","#concepto_id",function(){
    let opcion = $('input[name=opcion]:checked').val(); 
      if(opcion == 1){//cambio por codigo
        let id = this.value;
        $('#concepto_name').val(id).trigger('change');
        if( !id || id == null || id == ''){ 
          $('#categoria_gasto').val('');
          $('#subcategoria_gasto').val('');                  
        } else{
            console.log(id);
            $.ajax({
              type: 'GET',
              url:`../concepto_gastos/${id}/edit`,
              dataType : 'json',
              success: (data)=>{
                $('#categoria_gasto').val(data.categoria);
                $('#subcategoria_gasto').val(data.subcategoria); 
                console.log(data);     
              },
              error: (error)=>{
                toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
              }
            });
        }
      }
  });


} );
</script>    
@endsection