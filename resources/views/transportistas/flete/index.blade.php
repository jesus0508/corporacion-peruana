@extends('layouts.main')

@section('title','Transportistas')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Transportistas</a></li>
  <li><a href="#">Flete Pedidos</a></li>
</ol>
@endsection

@section('content')

<section class="content">
	@include('transportistas.flete.buttons_top')
  @include('transportistas.flete.table_fletes')
  @include('transportistas.flete.modal_pagar')
</section>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $("#modal-pagar-transportista").on("show.bs.modal", function(event) {      
    $.get('faltante/create', function( data ) {
        var html = "";
        console.log(data);
        data.forEach(function(val) {
          var keys = Object.keys(val);
          var prueba = 'futuro valor para saber si hay deuda con el proveedor';
          console.log(val);
        //  console.log(band);
          if( val != null ){ 
            html +='<div class="row">';
            html +=  '<div class="col-md-2"></div>';
            html +=  '<div class="col-md-8">';
            if ( prueba != null) {
                          html +=    '<a href="faltante/'+val['id']+'" class="btn  btn-block btn-lg btn-primary">'+val['nombre_transportista'];
            html +=    '</a> ';
            }
            html +=  '</div>';
            html +=  ' <div class="col-md-2"></div>';
            html +='</div>';
            html +='<p></p>';         
            $(".show-transportistas").html(html);
          }
        });     
    });   
  });

  var faltante    =$("#valor-faltante").val();//faltante de una fila
  console.log(faltante);
  $('#tabla-flete-pedidos').DataTable({  
      "ordering": false,    
      "responsive": true,             
      'language': {
        'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
      },

      "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        if ( faltante  != null  ){
          //$('td', nRow).css('background-color', '#f7c3c2');          
        }     
      }         
  });
});
</script>
@endsection
