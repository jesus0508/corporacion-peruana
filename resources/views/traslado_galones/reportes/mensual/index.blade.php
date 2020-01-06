@extends('layouts.main')

@section('title','Reporte')

@section('styles')
@include('reporte_excel.excel_select2_css')
<style>
    .ui-datepicker-calendar {
        display: none;
    }
</style>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Reporte Totales Mensual </a></li>
</ol>
@endsection


@section('content')
<section class="content">
 {{--  @include('traslado_galones.reporte.proovedores.create') --}}
  @include('traslado_galones.reportes.mensual.table')
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>

$(document).ready(function() {

  var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
	  $('#tabla-traslado-galones').DataTable({
      "responsive": true,
      "dom": 'Blfrtip',
      'ajax': `../reporte_clientes_grifos_mensual`,
        'columns': [
          {data: 'fecha',
           render: function (data, type, row) {
            let porciones = data;
            porciones = porciones.split('-');
            let mes = porciones[0];
            let year = porciones[1];
            mes = meses[Number(mes)-1];    
            return mes + ' ' + year;
           }    
          },
          {data: 'razon_social'},
          {data: 'grifos'},
          {data: 'clientes'},
          {data: 'total'}],
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Totales Mensual',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default',
        'exportOptions':
        {
          columns:[0,1,2,3,4]
        }
      }],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            getSubtotal(api,2);
            getSubtotal(api,3);
            getSubtotal(api,4);
      }
  });

  $('#fecha_inicio').datepicker({
     changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'mm-yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
  }); 
  $('#filtrar-fecha').click(function() {
    let fecha =$('#fecha_inicio').val();
    RefreshTable('#tabla-traslado-galones',`../reporte_clientes_grifos_mensual/${fecha}`);
  });
});

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
  function getSubtotal(api,column){
    pageTotal = api
                .column( column, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2); 
            // Update footer
            $( api.column( column ).footer() ).html(
                pageTotal
                // +' (S/.'+ total +' total)'
            );

  }

</script>
@endsection