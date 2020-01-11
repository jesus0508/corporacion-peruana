$(document).ready(function () {

  let $fecha_operacion_edit = $('#fecha_operacion-edit');
  let $fecha_reporte_edit = $('#fecha_reporte-edit');  
  $fecha_operacion_edit.datepicker();
  $fecha_reporte_edit.datepicker();

$('#modal-edit-movimientos').on('show.bs.modal',function(event){
    var id= $(event.relatedTarget).data('id');
    $.ajax({
      type: 'GET',
      url:`./movimientos/${id}/edit`,
      dataType : 'json',
      success: (data)=>{       
        $(event.currentTarget).find('#monto_operacion-edit').val(data.movimiento.monto_operacion);    
        $(event.currentTarget).find('#fecha_operacion-edit').val(data.movimiento.fecha_operacion);
        $(event.currentTarget).find('#fecha_reporte-edit').val(data.movimiento.fecha_reporte);
        $(event.currentTarget).find('#codigo_operacion-edit').val(data.movimiento.codigo_operacion);
        $(event.currentTarget).find('#banco-edit').val(data.movimiento.banco);
        $(event.currentTarget).find('#id-edit').val(data.movimiento.id);
      },
      error: (error)=>{
        toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
      }
    });
  });


  let $tabla_movimientos = $('#tabla-movimientos');
  let $fecha_operacion = $('#fecha_operacion');
  let $fecha_reporte = $('#fecha_reporte');

  $fecha_operacion.datepicker();
  $fecha_reporte.datepicker();
  $tabla_movimientos.DataTable({
      "responsive": true,
      "dom": 'Blfrtip',

      'ajax': `./movimientos_data_between/`,
        'columns': [
          {data: 'fecha_ingreso'},
          {data: 'fecha_operacion'},
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
        'title': 'Movimientos',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default',
        'exportOptions':
        {
          columns:[0,1,2,3,4,5]
        }
      }]
  });

  $('#fecha_inicio').datepicker(); 
  $('#fecha_fin').datepicker(); 
  
  $('#filtrar-fecha').click(function() {
    let fechaInicio =$('#fecha_inicio').val();
    fechaInicio = convertDateFormat(fechaInicio);
    let fechaFin =$('#fecha_fin').val();
    fechaFin = convertDateFormat(fechaFin);
    RefreshTable('#tabla-movimientos',`./movimientos_data_between/${fechaInicio}/${fechaFin}`);
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
        switch (estado) {
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
