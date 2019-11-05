@extends('layouts.main')

@section('title','Transporte')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet"></link>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
$(document).ready(function() {

  let $select_tipo = $('#tipo');
  let $select_tipo_edit = $('#tipo-edit');


  inicializarSelect2($select_tipo,'Seleccione tipo','');
  inicializarSelect2($select_tipo_edit,'Seleccione tipo','');
  //inicializarSelect2(); 
   $('#tabla-transporte').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
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