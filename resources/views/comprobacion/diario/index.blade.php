@extends('layouts.main')
@section('title','Ingresos')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Registrar Comprobacion</a></li>
  <li><a href="#">Reporte Comprobacion</a></li>
</ol>
@endsection

@section('content')
<section class="content">

    @include('comprobacion.diario.buttons_top')
    @include('comprobacion.diario.create')  	
  	@include('comprobacion.diario.table')
    @include('comprobacion.diario.table_ingresos')
    @include('comprobacion.diario.table_depositos') 
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
$(document).ready(function() {

var groupColumn = 1;
  //ingresos
  $('#tabla-reporte-comprobaciones').DataTable({
    "paging":   false,
    "ordering": true,//debe ser true to work
    "info":     false,
    "searching": true,//debe ser true to work
    "columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
    "order": [[ groupColumn, 'asc' ]],
    'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },

    "drawCallback": function ( settings ) {
          // $('#monto_comprobacion').val( 0 );
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
                    "colspan": 3, 
                    "style": "font-weight:bold;"  ,                
                    "text": "TOTAL: " 
                })).append($("<td></td>", {
                    "id": "C",
                    "style": "font-weight:bold;"  ,                     
                    "text":"00.0"
                })).prop('outerHTML'));
              }
                            
                let val  = api.row(api.row($(rows).eq(i)).index()).data();
                //Obtener subtotales +TOTAL
               // console.log(val);
                let elementoTOTAL       = document.getElementById("C");
                let total               = parseFloat(elementoTOTAL.innerHTML) + parseFloat( val[4]);
                elementoTOTAL.innerHTML = parseFloat(total).toFixed(2); 
                
                      
        });   
    }
  });
}); 

 

$(document).ready(function() {
	var groupColumn = 1;
  //ingresos
  $('#tabla-reporte-ingresos').DataTable({
  	"columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
    "order": [[ groupColumn, 'asc' ]],
    "paging":   false,
    "ordering": false,
    "info":     false,
    "searching": true,
    'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },

		"drawCallback": function ( settings ) {
           $('#monto_comprobacion').val( 0 );
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
                var total               = parseFloat(elementoTOTAL.innerHTML) + parseFloat( val[6]);
                elementoTOTAL.innerHTML = parseFloat(total).toFixed(2); 
                let subtotal            = parseFloat(elemento.innerHTML) + parseFloat( val[6]);                 
                elemento.innerHTML      = parseFloat(subtotal).toFixed(2); 
                      
        });   
           let elementoTOTAL       = document.getElementById("A");
          if (elementoTOTAL != null || elementoTOTAL!= undefined ) {
            let  totalComp = $('#monto_comprobacion').val();
            totalComp = parseFloat(totalComp);
            sub1 = parseFloat(elementoTOTAL.innerHTML);
            let comprobacionTotal =sub1 +totalComp;
            $('#monto_comprobacion').val( parseFloat(comprobacionTotal).toFixed(2) );
            let fecha_reporte = $('#fecha_inicio').val();
            if ( fecha_reporte == '') {             
              $('#monto_comprobacion').val(0.00);            
            }else{
              $('#total_egresos').val(parseFloat(sub1).toFixed(2)); 
            }
          }

    }
  });
 });    
  //depositos
$(document).ready(function() {
  var groupColumn = 1;
  $('#tabla-reporte-depositos').DataTable({
    "paging":   false,
    "ordering": true,//debe ser true to work
    "info":     false,
    "searching": true,//debe ser true to work
    "columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
    "order": [[ groupColumn, 'asc' ]],
    'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
    "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
              if( i == 0 ) {
                $(rows).eq( i ).before(
                      $("<tr style='background-color: #6F9EA0 !important;'></tr>", { 

                    "data-id": group
                }).append($("<td></td>", {
                    "colspan": 5, 
                    "style": "font-weight:bold;"  ,                
                    "text": "TOTAL: " 
                })).append($("<td></td>", {
                    "id": "B",
                    "style": "font-weight:bold;"  ,                     
                    "text":"00.0"
                })).prop('outerHTML'));
              }                
                if ( last !== group ) {
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

                let elemento            = document.getElementById("e"+val[1]);
                let elementoTOTAL       = document.getElementById("B");
                let total               = parseFloat(elementoTOTAL.innerHTML) + parseFloat( val[6]);
                elementoTOTAL.innerHTML = parseFloat(total).toFixed(2); 
                let subtotal            = parseFloat(elemento.innerHTML) + parseFloat( val[6]);                  
                elemento.innerHTML      = parseFloat(subtotal).toFixed(2);      
        });
          let elementoTOTAL       = document.getElementById("B");
          if (elementoTOTAL != null || elementoTOTAL!= undefined ) {
            let  totalComp = $('#monto_comprobacion').val();
            totalComp = parseFloat(totalComp);           
            let sub2 = parseFloat(elementoTOTAL.innerHTML);           
            let comprobacionTotal =sub2*-1 +totalComp;             
            $('#monto_comprobacion').val( parseFloat(comprobacionTotal).toFixed(2) );
            let fecha_reporte = $('#fecha_inicio').val();
            if ( fecha_reporte == '') {//si fecha reporte no sea ingresado           
              $('#monto_comprobacion').val(0.00);
            }else{
              $('#total_ingresos').val(parseFloat(sub2).toFixed(2));
            }

          }  
            
                      
    }
  });     
});


function validateDates() {
  let $tabla_pagos_lista1 = $('#tabla-reporte-ingresos');
  let $tabla_pagos_lista2 = $('#tabla-reporte-depositos');
  let $tabla_pagos_lista3 = $('#tabla-reporte-comprobaciones');
 
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
      var dia = $.datepicker.parseDate('d/m/yy', data[0]);
      if (!inicio || !dia || fin >= dia && inicio <= dia) {
        return true;
      }
      return false;
    }
  );

  $('#filtrar-fecha').on('click', function () {
    $tabla_pagos_lista1.DataTable().draw();//INGRESOS
    $tabla_pagos_lista2.DataTable().draw();//EGRESOS
    $tabla_pagos_lista3.DataTable().draw();//comprobaciones
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $('#fecha_fin').val("");
    $('#total_egresos').val("0");
    $('#total_ingresos').val("0");
    $tabla_pagos_lista1.DataTable().draw();
    $tabla_pagos_lista2.DataTable().draw();
    $tabla_pagos_lista3.DataTable().draw();
  });
}
$(document).ready(function() {
  validateDates();
});
</script>
@endsection