@extends('layouts.main')

@section('title','Egresos Grifos')

@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Egresos Grifos</a></li>
  <li><a href="#">Gestion</a></li>
</ol>
@endsection


@section('content')

<section class="content">
  @include('gastos.header')
  @include('gastos.create_categoria')  
  @include('gastos.create_subcategoria')
  @include('gastos.create_gasto')
  @include('gastos.table')

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
@include('reporte_excel.excel_select2_js')
<script>
  function confirmar(cadena=null){
    if(confirm('¿Estás seguro de eliminar '+cadena+'?'))
      return true;
    else
      return false;
  }
  function enfocarBottom(){
  var dest = $("#div-table").offset().top;
  $("html, body").animate({scrollTop: dest},600);  
}     

$(document).ready(function() {

  $('#tabla-lista-egresos-plantilla').DataTable({
    'responsive': false,
    'scrollX': true,
    columnDefs: [
          { orderable: false, targets: [-1]},
          { searchable: false, targets: [-1]},
      ],
    "dom": 'Blfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Gastos Descripción',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default',
        'exportOptions':
        {
          columns:[0,1,2,3,4]
        }
      }], 
  });

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
  // tabla gastos bottom
    $("#filter-categoria").prop('selectedIndex', -1);
    $("#filter-categoria").select2({
     placeholder: "Elija una categoría",
     allowClear:true
    });
    $("#filter-sub-categoria").prop('selectedIndex', -1);
    $("#filter-sub-categoria").select2({
      placeholder: "Elija un una subcateogria",
      allowClear:true
    });
  
  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      let categoria = $("#filter-categoria").find('option:selected').text();
      let cell = data[1];
      if (categoria) {
        return categoria === cell;
      }
      return true;
    }
  );

  $("#filter-categoria").on('change', function () {
    $('#tabla-lista-egresos-plantilla').DataTable().draw();
  });

  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      let sub_categoria = $("#filter-sub-categoria").find('option:selected').text();
      let cell = data[2];
      if (sub_categoria) {
        return sub_categoria === cell;
      }
      return true;
    }
  );

  $("#filter-sub-categoria").on('change', function () {
    $('#tabla-lista-egresos-plantilla').DataTable().draw();
  });
//end tabla bot
    $("#categoria").select2({
     placeholder: "Elija una categoría",
     allowClear:true
    });

    $("#subcategoria").select2({
      placeholder: "Elija un una subcategoria",
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
            $(event.currentTarget).find('#concepto_aea').val('');
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
            $(event.currentTarget).find('#codigo-edit-categoria').val(data.codigo);
            $(event.currentTarget).find('#categoria-edit').val(data.categoria);
            $(event.currentTarget).find('#id-edit-categoria').val(data.id);
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
            $(event.currentTarget).find('#codigo-edit-subcategoria').val(data.codigo);
            $(event.currentTarget).find('#subcategoria-edit').val(data.subcategoria);
            $(event.currentTarget).find('#id-edit-subcategoria').val(data.id);
          },
          error: (error)=>{
            toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
          }
      });
    });
    $('#modal-edit-concepto').on('show.bs.modal', function (event) {    
      let cod= $(event.relatedTarget).data('cod');//tabla id
      if (!cod) {
          cod= $('#cod_concepto_edit').val();//registro id
      }
      $.ajax({
          type: 'GET',
          url:`./concepto_gastos/${cod}`,
          dataType : 'json',

          success: (data)=>{
            $(event.currentTarget).find('#categoria-edit-concepto').val(data.concepto.sub_categoria_gasto.categoria_gasto.categoria);
            $(event.currentTarget).find('#subcategoria-edit-concepto').val(data.concepto.sub_categoria_gasto.subcategoria);
            $(event.currentTarget).find('#codigo-concepto-edit').val(data.concepto.codigo);
            $(event.currentTarget).find('#concepto-edit').val(data.concepto.concepto);
            $(event.currentTarget).find('#id-edit').val(data.concepto.id);
          },
          error: (error)=>{
            toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
          }
      });
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
              console.log(data);
              $('#cod_concepto_edit').val(cod);
              $('#id_concepto_delete').val(cod);
              $('#cod_concepto_right').val(data.concepto.codigo);
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
      "order": [[ 0, "desc" ]]
  });

</script>    
@endsection