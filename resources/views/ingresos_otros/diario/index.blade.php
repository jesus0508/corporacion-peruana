@extends('layouts.main')
@section('title','Ingresos')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ingresos</a></li>
  <li><a href="#">Registro</a></li>
</ol>
@endsection

@section('content')
<section class="content">

  	@include('ingresos_otros.diario.buttons_top')
  	@include('ingresos_otros.diario.table')

	<!-- modales -->
   @include('ingresos_otros.modal_categoria')
   <!-- fin modales -->
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
$(document).ready(function() {
	var groupColumn = 1;
  $('#tabla-reporte-ingresos').DataTable({
  	"columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
    "order": [[ groupColumn, 'asc' ]],
    'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
    //"ordering": ,
    //"searching": true,
		"drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
              if( i == 0 ) {
              	//console.log("una vez");
              	$(rows).eq( i ).before(
                    	$("<tr style='background-color: #5F9EA0 !important;'></tr>", { 

                    "data-id": group
                }).append($("<td></td>", {
                    "colspan": 5, 
                    "style": "font-weight:bold;"  ,                
                    "text": "TOTAL: " 
                })).append($("<td></td>", {
                    "id": "A",
                    "style": "font-weight:bold;"  ,                     
                    "text":"00.0"
                })).prop('outerHTML'));
              }
                
                if ( last !== group ) {
                	//	console.log(group);
                    $(rows).eq( i ).before(
                    	$("<tr style='background-color: #ddd !important;'></tr>", { 

                    "id": ""+group+"",              		
                    "class": "group",
                    "data-id": group
                }).append($("<td></td>", {
                    "colspan": 5, 
                    "style": "font-weight:bold;"  ,                
                    "text": "CATEGORÍA: " + group
                })).append($("<td></td>", {
                    "id": "e" + group,
                    "style": "font-weight:bold;"  ,                     
                    "value": "0.00",
                    "data-id": 0,
                    "text":"00.0"

                })).prop('outerHTML'));
                    last = group;
                }							
                let val  = api.row(api.row($(rows).eq(i)).index()).data();
                //Obtener subtotales +TOTAL
                let elemento            = document.getElementById("e"+val[1]);
                let elementoTOTAL       = document.getElementById("A");
                let total               = parseFloat(elementoTOTAL.innerHTML) + parseFloat( val[6]);
                elementoTOTAL.innerHTML = parseFloat(total).toFixed(2); 
                let subtotal            = parseFloat(elemento.innerHTML) + parseFloat( val[6]);                  
                elemento.innerHTML      = parseFloat(subtotal).toFixed(2);  
                      
        });
    },
    "footerCallback": function (row, data, start, end, display) {
        var api = this.api();
        $(api.column(6).footer()).html(
            api.column(6).data().reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            })
        );
        $(api.column(5).footer()).html(
            api.column(5).data().reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            })
        );
    }
  });     

});

function validateDates() {
	//console.log('entro a validate');
  let $tabla_pagos_lista = $('#tabla-reporte-ingresos');
 
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
      var dia = $.datepicker.parseDate('d/m/yy', data[3]);
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