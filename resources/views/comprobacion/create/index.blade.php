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
  <li><a href="#">Reporte</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  	@include('comprobacion.create.buttons_top')
    @include('comprobacion.create.create')    
  	@include('comprobacion.create.table')
    @include('comprobacion.create.table_ingresos')
    @include('comprobacion.create.table_depositos') 
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script>
$(document).ready(function() {

  $('#tabla-comprobaciones').DataTable({
    'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
    //"bProcessing": true,
    //'serverSide': true, Kga el filtrado u.u
    'ajax': `../comprobaciones_dt`,
    'columns': [
      {data: 'fecha_reporte'  ,
        render: function ( data, type, row ) {
          // If display or filter data is requested, format the date
          if ( type === 'display' || type === 'filter' ) {             
               return ( moment(data).format('L') );                         
          }
          return data;
        }
      },
      {data: 'detalle'},
      {data: 'fecha'},
      {data: 'monto', render: $.fn.dataTable.render.number( ',', '.', 0, 'S/. ' )}
    ]     
  }); 

  function RefreshTable(tableId, urlData){
    $.getJSON(urlData, null, function( json ){
      table = $(tableId).dataTable();
      oSettings = table.fnSettings();
      table.fnClearTable(this);    
      console.log(json.data);
      let xd;
      for (var i=0; i<json.data.length; i++) {
        xd =json.data[i].fecha_reporte;
        json.data[i].fecha_reporte = moment(xd).format('L');
       // console.log(xd);        
        table.oApi._fnAddData(oSettings, json.data[i]);       
      } 
      oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();      
      table.fnDraw();
   
    });
  }

  $('#btn_filter2').click(function() {
    let sFecha_reporte =$('#fecha_reporte2').val(); 
    //console.log(sFecha_reporte);
   // let fecha_reporte = convertDateFormat(sFecha_reporte); 
    RefreshTable('#tabla-comprobaciones',`../comprobaciones_dt/${sFecha_reporte}`);
    //$('#tabla-comprobaciones').DataTable().ajax.url(`../comprobaciones_dt/${sFecha_reporte}`).load();
    console.log('flter');
  });

  $('#btn_register').click(function(e){//store GASTO  
    e.preventDefault(); 
    let monto =$('#monto').val();
    let fecha =$('#fecha').val();
    let sFecha_reporte =  $('#fecha_inicio').val();
    let fecha_reporte = convertDateFormat(sFecha_reporte);
    let detalle =$('#detalle').val();
    console.log(fecha_reporte);   
    let token =$('#token').val();
    $.ajax({
        url: `../comprobaciones`,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{
          monto: monto,
          fecha_reporte: fecha_reporte,  
          fecha: fecha,
          detalle: detalle         
        }

    }).done(function (data){
        $('#monto').val('');
        $('#detalle').val(''); 
      let sFecha_reporte =  $('#fecha_inicio').val();
      let fecha_reporte = convertDateFormat(sFecha_reporte);
        //let sFecha_reporte =$('#fecha_reporte2').val(); 
        console.log(sFecha_reporte);
      RefreshTable('#tabla-comprobaciones',`../comprobaciones_dt/${fecha_reporte}`);
      //$('#tabla-comprobaciones').DataTable().ajax.url(`../comprobaciones_dt/${sFecha_reporte}`).load();
      toastr.success(data.status, 'Comprobacion registrada con éxito', { timeOut: 2000 });
    });    
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

               //let elementoComp =document.getElementById("monto_comprobacion"); 
               //totalComp = parseFloat(elementoComp.innerHTML).toFixed(2) + parseFloat(total).toFixed(2);
              // elementoComp.innerHTML = totalComp;
          
               //$('#monto_comprobacion').val(total);
                      
        });   
            let elementoTOTAL       = document.getElementById("A");
            let  totalComp = $('#monto_comprobacion').val();
            totalComp = parseFloat(totalComp);
            sub1 = parseFloat(elementoTOTAL.innerHTML);
            let comprobacionTotal =sub1 +totalComp;
            $('#monto_comprobacion').val( comprobacionTotal );

    }
  });
 });    
  //depositos
$(document).ready(function() {
  var groupColumn = 1;
  $('#tabla-reporte-depositos').DataTable({
    "paging":   false,
    "ordering": false,
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
                //Obtener subtotales +TOTAL
              //  console.log(val);
                let elemento            = document.getElementById("e"+val[1]);
                let elementoTOTAL       = document.getElementById("B");
                let total               = parseFloat(elementoTOTAL.innerHTML) + parseFloat( val[6]);
                elementoTOTAL.innerHTML = parseFloat(total).toFixed(2); 
                let subtotal            = parseFloat(elemento.innerHTML) + parseFloat( val[6]);                  
                elemento.innerHTML      = parseFloat(subtotal).toFixed(2);  

            
        });
            let elementoTOTAL       = document.getElementById("B");
            let  totalComp = $('#monto_comprobacion').val();
            totalComp = parseFloat(totalComp);
            console.log(totalComp);
            let sub2 = parseFloat(elementoTOTAL.innerHTML);
            console.log(sub2);
            let comprobacionTotal =sub2*-1 +totalComp;
             console.log(comprobacionTotal);
            $('#monto_comprobacion').val( comprobacionTotal );
                      
    }
  });     
});

  function convertDateFormat(string) {
        var info = string.split('/').reverse().join('-');
        return info;
  }

function validateDates() {
 //let  totalComp = $('#monto_comprobacion').val();
 //// // let sub1 =  document.getElementById("A").innerHTML;
 //  let ex = document.getElementById("B");
 // console.log(totalComp);
 //  console.log(ex);
  //let sub2 = 12;
 // let totalCompValue = parseFloat(sub1).toFixed(2) + parseFloat(sub2).toFixed(2);
  //$('#monto_comprobacion').val(totalCompValue);

	//console.log('entro a validate');
  let $tabla_pagos_lista1 = $('#tabla-reporte-ingresos');
  let $tabla_pagos_lista2 = $('#tabla-reporte-depositos');
 
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
    $tabla_pagos_lista1.DataTable().draw();
    $tabla_pagos_lista2.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $('#fecha_fin').val("");
    $tabla_pagos_lista1.DataTable().draw();
    $tabla_pagos_lista2.DataTable().draw();
  });
}
$(document).ready(function() {
  validateDates();
});
</script>
@endsection