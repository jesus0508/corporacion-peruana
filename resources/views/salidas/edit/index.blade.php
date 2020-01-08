@extends('layouts.main')
@section('title','Egresos')
@section('styles')
{{-- select2 4.0.8 --}}
<link rel="stylesheet" href="{{asset('dist/css/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Egresos</a></li>
  <li><a href="#">Modificación</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  	@include('salidas.edit.buttons_top')
  	@include('salidas.edit.table')
	<!-- modales -->
    @include('salidas.edit.modal_edit')
   <!-- fin modales -->
</section>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/select2/select2.min.js') }}"></script>
<script>
$(document).ready(function() {

  $('#fecha_inicio').datepicker();
  let fecha_inicio =  $('#fecha_inicio').val();
  fecha_inicio = convertDateFormat(fecha_inicio);
 
  $('#fecha_egreso').datepicker();
  $('#fecha_reporte').datepicker();
  $select_categorias = $('#categoria_egreso_id');
  $select_cuentas = $('#cuenta_id');

  $('#modal-edit-salidas').on('show.bs.modal',function(event){
    var id= $(event.relatedTarget).data('id');
    $.ajax({
      type: 'GET',
      url:`./salidas/${id}/edit`,
      dataType : 'json',
      success: (data)=>{        
        let categoria_id = data.salida.categoria_egreso_id;
        $(event.currentTarget).find('#monto_egreso').val(data.salida.monto_egreso);    
        $(event.currentTarget).find('#fecha_egreso').val(data.salida.fecha_egreso);
        $(event.currentTarget).find('#fecha_reporte').val(data.salida.fecha_reporte);
        $(event.currentTarget).find('#detalle').val(data.salida.detalle);
        $(event.currentTarget).find('#nro_comprobante').val(data.salida.nro_comprobante);
        $(event.currentTarget).find('#codigo_operacion').val(data.salida.codigo_operacion);
        $(event.currentTarget).find('#nro_cheque').val(data.salida.nro_cheque);
        $(event.currentTarget).find('#id-edit').val(data.salida.id);

        let lista_cuentas = '';
        data.cuentas.forEach((cuenta) => {
          lista_cuentas += `<option value="${cuenta.id}">${cuenta.nro_cuenta}</option>`;
        });
        $select_cuentas.html(lista_cuentas);
        inicializarSelect2($select_cuentas, 'Seleccione la categoría');
        $select_cuentas.val(categoria_id).trigger('change');
        
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

  $('#tabla-reporte-salidas').DataTable({
    'ajax': `./salidas_fecha_data/${fecha_inicio}`,
    'scrollX': 'false',
    'responsive': true,

    columnDefs: [
      { orderable: false, targets: -1},
      { searchable: false, targets: [-1]},
      { responsivePriority: 2, targets: [0,2] },         
      { responsivePriority: 10002, targets: [3,4,5] },
      { responsivePriority: 1, targets: [1,-1,2] }
    ],
    'columns': [
      {data: 'fecha_reporte'},
      {data: 'fecha_egreso'},
      {data: 'detalle'},
      {data: 'nro_cheque'}, 
      {data: 'nro_comprobante'},
      {data: 'cuenta_id'},       
      {data: 'monto_egreso' },  
      {data: 'action'}
    ]      
  });     

});

  function convertDateFormat(string) {
        var info = string.split('/').reverse().join('-');
        return info;
  }

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
    RefreshTable('#tabla-reporte-salidas',`./salidas_fecha_data/${fecha_inicio}`);
  });

  $('#clear-fecha').click(function() {
    $('#fecha_inicio').val('');
    RefreshTable('#tabla-reporte-salidas',`./salidas_fecha_data`);
  });


</script>
@endsection