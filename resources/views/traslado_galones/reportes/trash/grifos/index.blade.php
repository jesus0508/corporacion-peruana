@extends('layouts.main')

@section('title','Traspaso')

@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Reporte Grifos|Clientes Total Diario </a></li>
</ol>
@endsection


@section('content')
<section class="content">
 {{--  @include('traslado_galones.reporte.proovedores.create') --}}
  @include('traslado_galones.reportes.grifos.table')
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>

$(document).ready(function() {

	  $('#tabla-traslado-galones').DataTable({
      "responsive": true,
      "dom": 'Blfrtip',
      'ajax': `../traslado_galones_reporte_diario`,
        'columns': [
          {data: 'fecha', 
            "render": function(data, type, full, meta) {
               let fecha = convertDateFormat2(data);
              return fecha;
            }
          },
          {data: 'razon_social'},
          {data: 'grifos'},
          {data: 'clientes'},
          {data: 'total'}],
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Totales Grifo - Clientes - Proveedores',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default',
        'exportOptions':
        {
          columns:[0,1,2,3]
        }
      }]
  });


  $('#fecha_inicio').datepicker(); 
  $('#filtrar-fecha').click(function() {
    let fecha =$('#fecha_inicio').val();
    fecha = convertDateFormat(fecha);
    RefreshTable('#tabla-traslado-galones',`../traslado_galones_reporte_diario/${fecha}`);
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

</script>
@endsection