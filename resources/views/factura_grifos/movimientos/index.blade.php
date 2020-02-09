
@extends('layouts.main')
@section('title','Movimientos Grifos')
@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Grifos</a></li>
  <li><a href="#">Movimentos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('factura_grifos.movimientos.table')
</section>
  @include('factura_grifos.movimientos.create')
  @include('factura_grifos.movimientos.modal_edit')
  
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>

$(document).ready(function () {
  $('#grifo_id').select2({
        dropdownParent: $('#modal-create-movimiento')
    });

  let $tabla_movimiento_grifos = $('#tabla-movimiento-grifos');
  let $fecha_operacion = $('#fecha_operacion');
  let $fecha_reporte = $('#fecha_reporte');
  $fecha_operacion.datepicker();
  $fecha_reporte.datepicker(); 

  let $fecha_operacion_edit = $('#fecha_operacion-edit');
  let $fecha_reporte_edit = $('#fecha_reporte-edit');  
  $fecha_operacion_edit.datepicker();
  $fecha_reporte_edit.datepicker();

$('#modal-edit-movimientos-grifos').on('show.bs.modal',function(event){
    var id= $(event.relatedTarget).data('id');
    $.ajax({
      type: 'GET',
      url:`./movimiento_grifos/${id}/edit`,
      dataType : 'json',
      success: (data)=>{      
         
        $(event.currentTarget).find('#monto_operacion-edit').val(data.movimientoGrifo.monto_operacion);    
        $(event.currentTarget).find('#fecha_operacion-edit').val(data.movimientoGrifo.fecha_operacion);
        $(event.currentTarget).find('#fecha_reporte-edit').val(data.movimientoGrifo.fecha_reporte);
        $(event.currentTarget).find('#tipo-edit').val(data.movimientoGrifo.tipo);        
        $(event.currentTarget).find('#codigo_operacion-edit').val(data.movimientoGrifo.codigo_operacion);
        $(event.currentTarget).find('#banco-edit').val(data.movimientoGrifo.banco);
        $(event.currentTarget).find('#id-edit').val(data.movimientoGrifo.id);
      },
      error: (error)=>{
        toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
      }
    });
  });

  $tabla_movimiento_grifos.DataTable({
      "responsive": false,
      "scrollX": true,
      "dom": 'Blfrtip',

      'ajax': `./movimientos_grifos_data_between/`,
        'columns': [
          {data: 'fecha_reporte'},//fecha ingreso
          {data: 'fecha_operacion'},//fecha reporte
          {data: 'tipo' , 'render': function(data){
            return getTipo(data);
          }},
          {data: 'codigo_operacion'},
          {data: 'monto_operacion'},
          {data: 'banco'},          
          {data: 'estado', 'render': function(data){
            return getEstado(data);
          }},
          {data: 'action'}
        ],
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Movimiento Grifos',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default',
        'exportOptions':
        {
          columns:[0,1,2,3,4,5,6]
        }
      }]
  });



  $('#fecha_inicio').datepicker({
    numberOfMonths: 2,
    onSelect: function (selected) {
      $('#fecha_fin').datepicker('option', 'minDate', selected)
    }
  });
  $('#fecha_fin').datepicker({
    numberOfMonths: 2,
    onSelect: function (selected) {
      $('#fecha_inicio').datepicker('option', 'maxDate', selected)
    }
  });
  
  $('#filtrar-fecha').click(function() {
    let fechaInicio =$('#fecha_inicio').val();
    fechaInicio = convertDateFormat(fechaInicio);
    let fechaFin =$('#fecha_fin').val();
    fechaFin = convertDateFormat(fechaFin);
    RefreshTable('#tabla-movimiento-grifos',`./movimientos_grifos_data_between/${fechaInicio}/${fechaFin}`);
  });
});

  function convertDateFormat(string) {
        var info = string.split('/').reverse().join('-');
        return info;
  }
  function convertDateFormat2(string) {
        var info = string.split('-').reverse().join('/');
        return info;
  }
  function inicializarSelect2($select, text, data) {
    $select.select2({
      placeholder: text,
      data: data
    });
  }
  function RefreshTable(tableId, urlData){
    $.getJSON(urlData, null, function( json ){
      table = $(tableId).dataTable();
      oSettings = table.fnSettings();
      table.fnClearTable(this);    
      console.log(json.data);
      for (var i=0; i<json.data.length; i++) {
        table.oApi._fnAddData(oSettings, json.data[i]);       
      } 
      oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();      
      table.fnDraw();
   
    });
  }
  function getEstado(estado)
    {
        let result = "";
        switch (Number(estado)) {
            case 3:
                result = "<span class='label label-success'>Conforme</span>";
                break;
            case 2:
                result = "<span class='label label-warning'>Sin registrar</span>";
                break;
            default:
                result = "<span class='label label-info'>Sin Verificar</span>";                break;
        }
        return result;
    }
  function getTipo(tipo){
    let result = "";
        switch (Number(tipo)) {
            case 2:
                result = "Grifo";
                break;
            case 1:
                result = "Pendiente";
                break;
            default:
                result = "S/N";
                break;
        }
        return result;
  }

</script>
@endsection