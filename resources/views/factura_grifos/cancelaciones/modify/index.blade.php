@extends('layouts.main')

@section('title','Venta Facturada')
@section('styles')


@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{route('grifos.index')}}">Grifos</a></li>
  <li><a href="{{route('factura_grifos.create')}}">Facturacion Venta Grifo</a></li>
  <li><a href="#">Cancelaciones</a></li>
  <li><a href="#">Modificar</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include( 'factura_grifos.cancelaciones.modify.header' )
  <p></p>
  @include('factura_grifos.cancelaciones.modify.table')
{{--   modal  --}}
  @include('factura_grifos.cancelaciones.modify.edit')
{{--   modal.edit-end --}}
</section>
@endsection

@section('scripts')
<script>

$(document).ready(function() {

  $('#fecha-edit').datepicker();
  /*--------  Edit Cancelacion  --------------------*/
  $('#modal-edit-cancelacion').on('show.bs.modal',function(event){
    var id= $(event.relatedTarget).data('id');
    $.ajax({
      type: 'GET',
      url:`../cancelacion/${id}/edit`,
      dataType : 'json',
      success: (data)=>{        
        let fecha = convertDateFormat2(data.cancelacion.fecha);
        let monto = data.cancelacion.monto;
        let nro_operacion = data.cancelacion.nro_operacion;
        $(event.currentTarget).find('#monto-edit').val(monto);
        $(event.currentTarget).find('#fecha-edit').val(fecha);
        $(event.currentTarget).find('#nro_operacion-edit').val(nro_operacion);
        $(event.currentTarget).find('#facturacion_grifo_id-edit').val(data.cancelacion.facturacion_grifo_id);
        $(event.currentTarget).find('#id-edit').val(data.cancelacion.id);
      },
      error: (error)=>{
        toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
      }
    });
  });
  /*--------  Table Cancelacion  --------------------*/
  $('#tabla-cancelaciones-modify').DataTable({
    'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
    "order": [[ 3, "desc" ]],
    "responsive": true,
    "searching":true,
    "columnDefs": [
        { orderable: false, targets: [0,6]},
        { searchable: false, targets: [0,6]},
        { responsivePriority: 2, targets: [3,4,5] },         
        { responsivePriority: 1, targets: [1,2,-1] }
      ]
  });
}); 
/*--------  Convertir Formato FROM aaaa-mm-dd TO dd/mm/aaaa   --------------------*/
  function convertDateFormat2(string) {
        var info = string.split('-').reverse().join('/');
        return info;
  }

</script>
@endsection