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
  <div class="row">
    <div class="col-md-3">
      
    </div>
    <div class="col-md-5">
      <div class="row filtrado">
        <div class="col-md-6" >
          <button id="filtrar-fecha" class="btn btn-info">
            <i class="fa fa-search"></i>
            Filtrar
          </button>
          <button id="clear-fecha" class="btn btn-danger">
            <i class="fa fa-remove "></i>
            Limpiar
          </button>
        </div>
      </div>
    </div>
  </div>
  <form action="">
    @include('comprobacion.create.buttons_top')
    @include('comprobacion.create.create') 
  </form>
  	

  	@include('comprobacion.create.table')
    @include('comprobacion.create.table_ingresos')
    @include('comprobacion.create.table_depositos') 
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
$(document).ready(function() {

  $('#fecha').datepicker({
   //minDate: 0,
  });
 $('#fecha_reporte2').datepicker({
   //minDate: 0,
  });
  $('#tabla-comprobaciones').DataTable({
    'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
    //"bProcessing": true,
    //'serverSide': true, Kga el filtrado u.u
    "paging":   false,
    "ordering": false,
    "info":     false,
    "searching": true,
    'ajax': `../comprobaciones_dt`,
    'columns': [
      {data: 'fecha_reporte'},
      {data: 'detalle'},
      {data: 'fecha'},
      {data: 'monto'}
    ],"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
  
            // Update footer
            $( api.column( 3 ).footer() ).html(
                '  S/. '+ total 
            );
            let monto_comprobacion =  $('#monto_comprobacion').val();
            $('#restante_comprobacion').val( parseFloat(monto_comprobacion- total).toFixed() );
        

        } 
     
  }); 
function evaluarBtn(){
  let res_comp = $('#restante_comprobacion').val();
  let comp =$('#monto_comprobacion').val();
  if(res_comp == comp){
    $('#btn_register').hide();
  }else{
    $('#btn_register').show();
  }
}


  $('#btn_filter2').click(function() {
    let fecha_reporte =$('#fecha_reporte2').val();
    fecha_reporte = convertDateFormat(fecha_reporte); 
    RefreshTable('#tabla-comprobaciones',`../comprobaciones_dt/${fecha_reporte}`);
    //$('#tabla-comprobaciones').DataTable().ajax.url(`../comprobaciones_dt/${sFecha_reporte}`).load();
   
  });

  $('#btn_register').click(function(e){//store GASTO  
    e.preventDefault();
   // console.log( evaluarComprobacion() );
    if( evaluarComprobacion() == 1 ){ 

      let monto =$('#monto').val();
      let sFecha =$('#fecha').val();
      let fecha = convertDateFormat(sFecha);
      let sFecha_reporte =  $('#fecha_inicio').val();
      let fecha_reporte = convertDateFormat(sFecha_reporte);
      let detalle =$('#detalle').val(); 
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
        RefreshTable('#tabla-comprobaciones',`../comprobaciones_dt/${fecha_reporte}`);
        //$('#tabla-comprobaciones').DataTable().ajax.url(`../comprobaciones_dt/${sFecha_reporte}`).load();
        toastr.success(data.status, 'Comprobacion registrada con éxito', { timeOut: 2000 });
      }); 
    }else{
      alert('Debes rellenar todos los campos');
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

function evaluarComprobacion(){
  let bandera = 1;
  let monto =$('#monto').val();
  let sFecha =$('#fecha').val();  
  let sFecha_reporte =  $('#fecha_inicio').val();
  let detalle =$('#detalle').val(); 
  if( monto == '' || sFecha == ''
      || sFecha_reporte == '' || detalle == '' ){
    bandera = -1;
    // console.log(detalle);
    return bandera;
  }
  return bandera;

}
function RefreshTable(tableId, urlData){
    $.getJSON(urlData, null, function( json ){
      table = $(tableId).dataTable();
      oSettings = table.fnSettings();
      table.fnClearTable(this);    
      let fecha_reporte;
      for (var i=0; i<json.data.length; i++) {
        fecha_reporte =json.data[i].fecha_reporte;
        json.data[i].fecha_reporte = convertDateFormat2(fecha_reporte);      
        table.oApi._fnAddData(oSettings, json.data[i]);       
      } 
      oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();      
      table.fnDraw();   
    });
  }

function convertDateFormat(string) {
        var info = string.split('/').reverse().join('-');
        return info;
  }

function convertDateFormat2(string) {
        var info = string.split('-').reverse().join('/');
        return info;
  }

function validateDates() {
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
    $tabla_pagos_lista1.DataTable().draw();//INGRESOS
    $tabla_pagos_lista2.DataTable().draw();//EGRESOS

  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $('#fecha_fin').val("");
    $('#total_egresos').val("0");
    $('#total_ingresos').val("0");
    $tabla_pagos_lista1.DataTable().draw();
    $tabla_pagos_lista2.DataTable().draw();
  });
}
$(document).ready(function() {
  validateDates();
});
</script>
@endsection