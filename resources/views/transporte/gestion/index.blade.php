@extends('layouts.main')

@section('title','Transporte')

@section('styles')
{{-- select2 4.0.8 --}}
<link rel="stylesheet" href="{{asset('dist/css/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Transporte</a></li>
  <li><a href="#">Registro</a></li>
</ol>
@endsection


@section('content')
<section class="content">
  @include('transporte.gestion.create')
  @include('transporte.gestion.table') 
  
  <!--modales-->
  @include('transporte.gestion.edit')
  <!--/.end-modales-->
</section>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/select2/select2.min.js') }}"></script>
<script>
$(document).ready(function() {

  let $select_tipo = $('#tipo');
  let $select_tipo_edit = $('#tipo-edit');


  inicializarSelect2($select_tipo,'Seleccione tipo','');
 // inicializarSelect2Modal($select_tipo_edit, 'Seleccione tipo', '','modal-edit-transporte')
  //inicializarSelect2(); 
   $('#tabla-transporte').DataTable({
      "responsive": true
    });
	});

  $('#modal-edit-transporte').on('show.bs.modal', function (event) {     
    var id= $(event.relatedTarget).data('id');
    $.ajax({
      type: 'GET',
      url:`./transporte/${id}`,
      dataType : 'json',
      success: (data)=>{
        $('#tipo-edit').val(data.tipo).trigger('change');       
        $(event.currentTarget).find('#chofer-edit').val(data.chofer);
        $(event.currentTarget).find('#placa-edit').val(data.placa); 
        $(event.currentTarget).find('#id-edit').val(data.id); 
      },
      error: (error)=>{
        toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
      }
    });
});

 function inicializarSelect2Modal($select, text, data,modal) {
  $select.prop('selectedIndex', -1);
  $select.select2({
    placeholder: text,
    dropdownParent: $("#"+modal),
    allowClear: true,
    data: data
    });
  }
function inicializarSelect2($select, text, data) {
  $select.prop('selectedIndex', -1);
  $select.select2({
    placeholder: text,
    allowClear: true,
    data: data
    });
  }
</script>
@endsection