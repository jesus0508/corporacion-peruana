@extends('layouts.main')

@section('title','Transportistas')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Transportistas</a></li>
  <li><a href="#">Flete Pedidos</a></li>
  <li><a href="#">Registrar Faltante</a></li>
</ol>
@endsection

@section('content')

<section class="content">
  <!--modal -->
	@include('transportistas.registrar_faltante.create') 
    <!--modal end -->

  @include('transportistas.registrar_faltante.table')
</section>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
$(document).ready(function() {
  $("#faltante").on('change',function(){
    let faltante    =$("#faltante").val();
    let costo_galon =$("#costo_galon-edit").val();
    let monto = faltante * costo_galon;
    monto = parseFloat(monto).toFixed(2);
    $("#monto_descuento").val(monto);
  });
  
    $('#tabla-flete-pedidos-sin-pagar').DataTable({      
          "responsive": true,             
        'language': {
        'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
      }   
    });

});
  $('#modal-registrar-faltante').on('show.bs.modal', function (event) {
    let id = $(event.relatedTarget).data('pivote');
    let pedido_cliente_id = $(event.relatedTarget).data('pedido_cliente_id');
    if( pedido_cliente_id ){
      $.ajax({
        type: 'GET',
        url: `./${id}/edit`,
        dataType: 'json',
        success: (data) => {
          console.log(data);
          $(event.currentTarget).find('#transportista').val(data.nombre_transportista);
          $(event.currentTarget).find('#tipo').val('CLIENTE ');
          $(event.currentTarget).find('#fecha_descarga').val(data.fecha_descarga);//
          $(event.currentTarget).find('#razon_social').val(data.razon_social);
          $(event.currentTarget).find('#costo_galon-edit').val(data.costo_galon);
          $(event.currentTarget).find('#descripcion').val(data.descripcion);
          $(event.currentTarget).find('#id_pivote').val(data.id_pivote);
          $(event.currentTarget).find('#pedido_cliente_id').val(data.pedido_cliente_id);
        },
        error: (error) => {
          toastr.error('Ocurrio un Error!', 'Error Alert', { timeOut: 2000 });
        }
      });
    } else{
            $.ajax({
        type: 'GET',
        url: `./${id}`,
        dataType: 'json',
        success: (data) => {
          console.log(data);
          $(event.currentTarget).find('#transportista').val(data.nombre_transportista);
          $(event.currentTarget).find('#tipo').val('GRIFO ');
          $(event.currentTarget).find('#fecha_descarga').val('sin acordar');//
          $(event.currentTarget).find('#razon_social').val(data.razon_social);
          $(event.currentTarget).find('#costo_galon-edit').val(data.costo_galon);
          $(event.currentTarget).find('#descripcion').val(data.descripcion);
          $(event.currentTarget).find('#id_pivote').val(data.id_pivote);
          $(event.currentTarget).find('#pedido_cliente_id').val(null);
        },
        error: (error) => {
          toastr.error('Ocurrio un Error!', 'Error Alert', { timeOut: 2000 });
        }
      });

    }


  });//fin  show.bs.modal

</script>
@endsection