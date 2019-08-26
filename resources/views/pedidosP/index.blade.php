@extends('layouts.main')

@section('title','Proveedores')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{route('pedidos.index')}}">Pedidos</a></li>
  <li><a href="{{route('pedidos.create')}}">Registro</a></li>
</ol>
@endsection

@section('content')

<section class="content">
    @include('pedidosP.table')
    <!-- mODAL-->
    @include('pedidosP.edit')
    @include('pago_proveedores.modal')
    <!-- End mODAL-->
</section>


@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/pedidos.js') }}"></script> 
<script>
$(document).ready(function(){
  function hasFactura(id){
      console.log(id);
  return 
    $.ajax({
      type: 'GET',
      url:`./show_pedido_completo/${id}`,
      dataType : 'json'      
    }); 
    }

  $("#modal-pagar-proveedor").on("show.bs.modal", function(event) {
      
    $.get('pago_proveedors/create', function( data ) {
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
                          html +=    '<a href="pago_proveedors/'+val['id']+'" class="btn  btn-block btn-lg btn-success">'+val['razon_social'];
            html +=    '</a> ';
            }
            html +=  '</div>';
            html +=  ' <div class="col-md-2"></div>';
            html +='</div>';
            html +='</br>';            

            $(".show-proveedores").html(html);
          }

        });     
    });

   
  });


});

$(document).ready(function() {
  $('#proveedores').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "responsive": true,
      "ordering": false,

        columnDefs: [
          { orderable: false, targets: -1},
          { searchable: false, targets: [-1]},
          { responsivePriority: 2, targets: 0 },
          { responsivePriority: 10001, targets: 2 },
          { responsivePriority: 10002, targets: 5 },
          { responsivePriority: 1, targets: -1 }
        ],

      "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        if ( aData[6] == aData[5] ){ //igual no pasa nada
          //$('td', nRow).css('background-color', '#ffcdd2');               
        }else if(aData[6] < aData[5] ){//si montoFactura < monto anterior
          $('td', nRow).css('background-color', '#A9F5D0');//verde
        if( aData[6] == 0.00 ){
           $('td', nRow).css('background-color', '#D8D8D8');
            }

        }else{
           $('td', nRow).css('background-color', '#ffcdd2');
        }

      }
  });
});
</script>
@endsection