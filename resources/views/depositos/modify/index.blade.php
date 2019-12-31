@extends('layouts.main')

@section('title','Ingresos y Egresos')
@section('styles')
{{-- select2 4.0.8 --}}
<link rel="stylesheet" href="{{asset('dist/css/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ingresos && Egresos</a></li>
  <li><a href="#">Depositos</a></li>
  <li><a href="#">Modificar</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('depositos.modify.header') 
  @include('depositos.modify.table')
  {{-- modal.edit --}}
  @include('depositos.modify.edit')
  
</section>
@endsection
@section('scripts')
<script src="{{ asset('dist/js/select2/select2.min.js') }}"></script>
<script>
$(document).ready(function() {


  $select_cuentas = $('#cuenta_id');
  $('#modal-edit-deposito').on('show.bs.modal',function(event){
    var id= $(event.relatedTarget).data('id');
    $.ajax({
      type: 'GET',
      url:`./depositos/${id}/edit`,
      dataType : 'json',
      success: (data)=>{      
        $(event.currentTarget).find('#monto').val(data.deposito.monto);
        $(event.currentTarget).find('#detalle').val(data.deposito.detalle);
        $(event.currentTarget).find('#codigo_operacion').val(data.deposito.codigo_operacion);
        $(event.currentTarget).find('#fecha_reporte').val(data.deposito.fecha_reporte);
        $(event.currentTarget).find('#id-edit').val(data.deposito.id);
        let cuenta_id = data.deposito.cuenta_id;        
        let lista_cuentas = '';
        data.cuentas.forEach((cuenta) => {
          lista_cuentas += `<option value="${cuenta.id}">${cuenta.nro_cuenta}</option>`;
        });
        $select_cuentas.html(lista_cuentas);
        inicializarSelect2($select_cuentas, 'Seleccione la cuenta');
        $select_cuentas.val(cuenta_id).trigger('change');
      },
      error: (error)=>{
        toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
      }
    });
  });

 $('#fecha_inicio').datepicker(); 
  $('#tabla-depositos').DataTable({
    'ajax': `./depositos_fecha_data`,
    'scrollX': 'true',
    'columns': [
      {data: 'fecha_reporte'},
      {data: 'nro_cuenta'},
      {data: 'detalle'},
      {data: 'codigo_operacion'},
      {data: 'monto' },  
      {data: 'action'}
    ]      
  }); 

  function inicializarSelect2($select, text, data) {
    $select.select2({
      placeholder: text,
      allowClear: true,
      data: data
    });
  }
  function convertDateFormat(string) {
        var info = string.split('/').reverse().join('-');
        return info;
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
    let fecha_reporte =$('#fecha_inicio').val();
    fecha_reporte = convertDateFormat(fecha_reporte); 
    RefreshTable('#tabla-depositos',`./depositos_fecha_data/${fecha_reporte}`);
  });

  $('#clear-fecha').click(function() {
    $('#fecha_inicio').val('');
    let fecha_reporte = '2000-01-01';//dia random para que no devuelva registros.
    RefreshTable('#tabla-depositos',`./depositos_fecha_data/${fecha_reporte}`);
  });

});
</script>
@endsection