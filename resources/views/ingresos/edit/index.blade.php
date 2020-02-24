@extends('layouts.main')
@section('title','Ingresos')
@section('styles')
{{-- select2 4.0.8 --}}
<link rel="stylesheet" href="{{asset('dist/css/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ingresos</a></li>
  <li><a href="#">Reporte</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  	@include('ingresos.edit.buttons_top')
  	@include('ingresos.edit.table')
	<!-- modales -->
    @include('ingresos.edit.modal_edit')
   <!-- fin modales -->
</section>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/select2/select2.min.js') }}"></script>
<script>
$(document).ready(function() {

  $('#fecha_inicio').datepicker();
  $('#fecha_reporte').datepicker();
  $('#fecha_ingreso').datepicker();
  $select_categorias = $('#categoria_ingreso_id');
  $select_bancos = $('#banco');
  let fecha_inicio =  $('#fecha_inicio').val();
  fecha_inicio = convertDateFormat(fecha_inicio);
 // console.log(fecha_inicio);
  $('#modal-edit-ingresos').on('show.bs.modal',function(event){
    var id= $(event.relatedTarget).data('id');
    $.ajax({
      type: 'GET',
      url:`./ingresos_otros/${id}/edit`,
      dataType : 'json',
      success: (data)=>{        
        console.log(data);

        let categoria_id = data.ingreso.categoria_ingreso_id;
        let fecha_ingreso = data.ingreso.fecha_ingreso;
        let fecha_reporte = data.ingreso.fecha_reporte;
        let banco_id = data.ingreso.banco;
        $(event.currentTarget).find('#monto_ingreso').val(data.ingreso.monto_ingreso);    
        $(event.currentTarget).find('#fecha_ingreso').val(fecha_ingreso);
        $(event.currentTarget).find('#fecha_reporte').val(fecha_reporte);
        $(event.currentTarget).find('#detalle').val(data.ingreso.detalle);
        $(event.currentTarget).find('#codigo_operacion').val(data.ingreso.codigo_operacion);
        $(event.currentTarget).find('#id-edit').val(data.ingreso.id);
          
        inicializarSelect2($select_bancos, 'Seleccione el banco');
        $select_bancos.val(banco_id).trigger('change');
        
        let lista_categorias = '';
        data.categorias.forEach((categoria) => {
          lista_categorias += `<option value="${categoria.id}">${categoria.categoria}</option>`;
        });
        $select_categorias.html(lista_categorias);
        inicializarSelect2($select_categorias, 'Seleccione la categoría');
        $select_categorias.val(categoria_id).trigger('change');
      },
      error: (error)=>{
        toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
      }
    });
  });

  $('#tabla-reporte-ingresos').DataTable({
    'ajax': `./ingresos_fecha_data/${fecha_inicio}`,
    'scrollX': 'true',
    'columns': [
      {data: 'fecha_reporte'},
      {data: 'fecha_ingreso'},
      {data: 'detalle'},
      {data: 'banco'},      
      {data: 'codigo_operacion'},
      {data: 'monto_ingreso' },  
      {data: 'action'}
    ]      
  });     

});

  function convertDateFormat(string) {
        var info = string.split('/').reverse().join('-');
        return info;
  }
  function inicializarSelect2($select, text) {
    $select.prop('selectedIndex', -1);
    $select.select2({
      placeholder: text,
      allowClear: true,
    });
  }

  function RefreshTable(tableId, urlData){
    $.getJSON(urlData, null, function( json ){
      table = $(tableId).dataTable();
      oSettings = table.fnSettings();
      table.fnClearTable(this);    
      //console.log(json.data);
      for (var i=0; i<json.data.length; i++) {
        table.oApi._fnAddData(oSettings, json.data[i]);       
      } 
      oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();      
      table.fnDraw();
   
    });
  }

  $('#filtrar-fecha').click(function() {
    let fecha_inicio =$('#fecha_inicio').val();
    fecha_inicio = convertDateFormat(fecha_inicio); 
    RefreshTable('#tabla-reporte-ingresos',`./ingresos_fecha_data/${fecha_inicio}`);
  });

  $('#clear-fecha').click(function() {
    $('#fecha_inicio').val('');
    RefreshTable('#tabla-reporte-ingresos',`./ingresos_fecha_data`);
  });


</script>
@endsection