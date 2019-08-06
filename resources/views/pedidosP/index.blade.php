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

$(document).ready(function() {
$('#proveedores').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },

        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if ( aData[4] >= aData[5] )

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