@extends('layouts.main')

@section('title','Reportes')
@section('styles')
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet"></link>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Reportes</a></li>
  <li><a href="#">Programación</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('programacion.header')
  @include('programacion.table')
</section>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script>
$(document).ready(function() {
	var groupColumn = 0;
  $('#tabla-reporte-programacion').DataTable({
  	"columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
    "order": [[ groupColumn, 'asc' ]],
    "dom": 'Bfrtip',
    "buttons": [
        
        {
          extend: 'excelHtml5',
          title: 'Programación',
          attr:  {
                title: 'Excel',
                id: 'excelButton'
            },
          text:     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
          className: 'btn btn-default',
          exportOptions:
            {
              columns:[1,2,3,4,5,6,7,8]
            }

         }
        ],
    'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
		"drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
              if( i == 0 ) {              	
              	$(rows).eq(i).before(
                    	$("<tr style='background-color: #5F9EA0 !important;'></tr>", { 
                    "data-id": group
                }).append($("<td></td>", {
                    "colspan": 2, 
                    "style": "font-weight:bold;"  ,                
                    "text": "TOTAL: " 
                })).append($("<td></td>", {
                    "id": "A",
                    "style": "font-weight:bold;"  ,                     
                    "text":"00.0"
                })).append($("<td></td>", {
                    "colspan": 5, 
                    "style": "font-weight:bold;"  ,                
                    "text": "" 
                })).prop('outerHTML'));
              }
                
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                    	$("<tr style='background-color: #ddd !important;'></tr>", { 

                    "id": ""+group+"",              		
                    "class": "group",
                    "data-id": group
                }).append($("<td></td>", {
                    "colspan": 8, 
                    "style": "font-weight:bold;"  ,                
                    "text": "Fecha Descarga: " + group
                })).prop('outerHTML'));
                    last = group;
                }	
            let val  = api.row(api.row($(rows).eq(i)).index()).data();
            let elementoTOTAL       = document.getElementById("A");
            let total               = parseInt(elementoTOTAL.innerHTML) + parseInt( val[3]);
            elementoTOTAL.innerHTML = parseInt(total);                
        });
    }
  });     

});

function validateDates() {

  let $tabla_pagos_lista = $('#tabla-reporte-programacion');
 
  $('#fecha_inicio').datepicker({
    numberOfMonths: 1,
    onSelect: function (selected) {
      $('#fecha_fin').datepicker('option', 'minDate', selected)
    }
  });
  $('#fecha_fin').datepicker({
    numberOfMonths: 1,
    onSelect: function (selected) {
      $('#fecha_inicio').datepicker('option', 'maxDate', selected)
    }
  });

  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $('#fecha_inicio').val();
      var sFin = $('#fecha_inicio').val();
      var inicio = $.datepicker.parseDate('d/m/yy', sInicio);
      var fin = $.datepicker.parseDate('d/m/yy', sFin);
      var dia = $.datepicker.parseDate('d/m/yy', data[1]);
      if (!inicio || !dia || fin >= dia && inicio <= dia) {
        return true;
      }
      return false;
    }
  );

  $('#filtrar-fecha').on('click', function () {
    $tabla_pagos_lista.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $('#fecha_fin').val("");
    $tabla_pagos_lista.DataTable().draw();
  });
}
$(document).ready(function() {
  validateDates();
});
</script>
@endsection