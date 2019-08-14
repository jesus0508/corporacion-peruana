@extends('layouts.main')

@section('title','Proveedores')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">


@endsection

@section('content')
<section class="content-header">
  <h1>
    GESTIÓN PEDIDOS PROVEEDORES
    <small>Optional description</small>
  </h1>
  @include('pedidosP.create')
</section>

  @include('pedidosP.table')

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/pedidos.js') }}"></script> 
<script>
$(document).ready(function(){

  $("#modal-pagar-proveedor").on("show.bs.modal", function(event) {
      
    $.get('pago_proveedors/create', function( data ) {
        var html = "";
        data.forEach(function(val) {
          var keys = Object.keys(val);
          console.log(val);
          if( val != null ){ 
            html +='<div class="row">';
            html +=  '<div class="col-md-2"></div>';
            html +=  '<div class="col-md-8">';
            html +=    '<a href="pago_proveedors/'+val['id']+'" class="btn  btn-block btn-lg btn-success">'+val['razon_social'];
            html +=    '</a> ';
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
                  columnDefs: [
            { responsivePriority: 2, targets: 0 },
            { responsivePriority: 10001, targets: 2 },
            { responsivePriority: 10002, targets: 5 },
            { responsivePriority: 1, targets: -1 }
        ],

        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if ( aData[6] >= aData[7] )

                    {

                        
                    }
                    else 
                    {
                        $('td', nRow).css('background-color', '#ffcdd2');
                    }
                }
    });
} );
</script>
@endsection