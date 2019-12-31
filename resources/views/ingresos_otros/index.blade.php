@extends('layouts.main')
@section('title','Ingresos')
@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ingresos</a></li>
  <li><a href="#">Registro</a></li>
</ol>
@endsection

@section('content')
<section class="content">
   @include('ingresos_otros.top_button')
  <form action="">
    @include('ingresos_otros.header')
    @include('ingresos_otros.create')
  </form>
  	
  	@include('ingresos_otros.table')

	<!-- modales -->
   @include('ingresos_otros.modal_categoria')
   <!-- fin modales -->
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')

<script>
$(document).ready(function() {
  $("#categoria_ingreso_id").prop("selectedIndex", -1);   

  $("#categoria_ingreso_id").select2({
    placeholder: "Seleccione la categoria",
    allowClear: true
  });

  $("#banco").prop("selectedIndex", -1);
  $("#banco").select2({
    placeholder: "Seleccione el banco",
    allowClear:true
  });
 $('#fecha_reporte').datepicker({
   //minDate: 0,
  });
 $('#fecha_ingreso').datepicker({
   //minDate: 0,
  });
 $('#fecha_reporte2').datepicker({
   //minDate: 0,
  }); 
  var groupColumn = 1;
  $('#tabla-ingresos').DataTable({
    'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "dom": 'Blfrtip',
      "responsive":false,
      "columnDefs": [
            { "visible": false, "targets": groupColumn }
      ],
         "order": [[ groupColumn, 'asc' ]],
        "scrollX": true,
          "buttons": [
          {
            'extend': 'excelHtml5',
            'title': 'Lista Ingresos Diario',
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
          }],
    //"bProcessing": true,
		//'serverSide': true, Kga el filtrado u.u
		'ajax': `../ingresos_otros_dt`,
		'columns': [
		  {data: 'fecha_reporte'},
		  {data: 'categoria'},
			{data: 'detalle'},
			{data: 'fecha_ingreso'},
			{data: 'codigo_operacion'},
      {data: 'banco'},
			{data: 'monto_ingreso'//, render: $.fn.dataTable.render.number( ',', '.', 0, '$' )
    }
		],
    "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
              if( i == 0 ) {
                console.log("una vez");
                console.log(group);
                $(rows).eq( i ).before(
                      $("<tr style='background-color: #5F9EA0 !important;'></tr>", { 

                    "data-id": group
                }).append($("<td></td>", {
                    "colspan": 5, 
                    "style": "font-weight:bold;"  ,                
                    "text": "TOTAL: " 
                })).append($("<td></td>", {
                  "colspan": 1, 
                    "id": "A",
                    "style": "font-weight:bold;"  ,                     
                    "text":"00.0"
                })).prop('outerHTML'));
              }
                
                if ( last !== group ) {
                  //  console.log(group);
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
                     "colspan": 1, 
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
                let elemento            = document.getElementById("e"+val['categoria']);
                let elementoTOTAL       = document.getElementById("A");
                var total               = parseFloat(elementoTOTAL.innerHTML) + 
                                            parseFloat( val['monto_ingreso']);
                elementoTOTAL.innerHTML = parseFloat(total).toFixed(2); 
                let subtotal            = parseFloat(elemento.innerHTML) 
                                            + parseFloat( val['monto_ingreso']);                  
                elemento.innerHTML      = parseFloat(subtotal).toFixed(2); 
              //$('#pruebita').val(total);
                      
        });   
    }      
  });  

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

	$('#btn_filter2').click(function() {
		let fecha_reporte =$('#fecha_reporte2').val();
    fecha_reporte = convertDateFormat(fecha_reporte);
		RefreshTable('#tabla-ingresos',`../ingresos_otros_dt/${fecha_reporte}`);

	});

  $('#btn_register').click(function(e){//store GASTO
    e.preventDefault();
    let categoria_ingreso_id = $('#categoria_ingreso_id').val();   
    let monto_ingreso =$('#monto_ingreso').val();
    let fecha_ingreso =$('#fecha_ingreso').val();
    fecha_ingreso = convertDateFormat(fecha_ingreso);
    let fecha_reporte =$('#fecha_reporte').val();
    fecha_reporte = convertDateFormat(fecha_reporte);
    let codigo_operacion =$('#codigo_operacion').val();  
    let detalle =$('#detalle').val();
    let token =$('#token').val();
    let banco = $('#banco').val();
    $.ajax({
        url: `../ingresos_otros`,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{
          monto_ingreso: monto_ingreso,
          fecha_reporte: fecha_reporte,  
          fecha_ingreso: fecha_ingreso,
          categoria_ingreso_id: categoria_ingreso_id,
          detalle: detalle,
          codigo_operacion: codigo_operacion,
          banco: banco
        }

    }).done(function (data){
        $('#monto_ingreso').val('');
        $('#detalle').val('');
  			$('#codigo_operacion').val('');
        $('#banco').val('').trigger('change');	
      RefreshTable('#tabla-ingresos',`../ingresos_otros_dt/${fecha_reporte}`);
      toastr.success(data.status, 'Ingreso registrado con éxito', { timeOut: 2000 });
    });    
  });

});
</script>
@endsection