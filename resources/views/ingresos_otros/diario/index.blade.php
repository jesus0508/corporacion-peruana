@extends('layouts.main')
@section('title','Ingresos')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet"></link>
<link href="https://unpkg.com/tableexport@5.2.0/dist/css/tableexport.css">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ingresos</a></li>
  <li><a href="#">Reporte</a></li>
</ol>
@endsection

@section('content')
<section class="content">

  	@include('ingresos_otros.diario.buttons_top')
  	@include('ingresos_otros.diario.table')

	<!-- modales -->
   @include('ingresos_otros.diario.modal_edit')
   <!-- fin modales -->
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

{{-- <script src="xlsx.core.js"></script> --}}
{{-- <script src="https://raw.githubusercontent.com/hhurz/tableExport.jquery.plugin/master/libs/FileSaver/FileSaver.min.js"> </script>
<script src="https://unpkg.com/tableexport@5.2.0/dist/js/tableexport.js"></script>
 --}}
<script>

$(document).ready(function() {

// $("#tabla-reporte-ingresos").tableExport();

  // $('#fecha_ingreso').datepicker();
  // $('#fecha_reporte').datepicker();
  $select_categorias = $('#categoria_ingreso_id');
  $select_bancos = $('#banco');
  $('#modal-edit-ingresos').on('show.bs.modal',function(event){
    var id= $(event.relatedTarget).data('id');
    $.ajax({
      type: 'GET',
      url:`./ingresos_otros/${id}/edit`,
      dataType : 'json',
      success: (data)=>{        
        console.log(data);

        let categoria_id = data.ingreso.categoria_ingreso_id;
        let fecha_ingreso = data.ingreso.fecha_ingreso;
        let fecha_reporte = data.ingreso.fecha_reporte;
        let banco_id = data.ingreso.banco;
        $(event.currentTarget).find('#monto_ingreso').val(data.ingreso.monto_ingreso);    
        $(event.currentTarget).find('#fecha_ingreso').val(fecha_ingreso);
        $(event.currentTarget).find('#fecha_reporte').val(fecha_reporte);
        $(event.currentTarget).find('#detalle').val(data.ingreso.detalle);
        $(event.currentTarget).find('#codigo_operacion').val(data.ingreso.codigo_operacion);
        $(event.currentTarget).find('#id-edit').val(data.ingreso.id);
          
        inicializarSelect2($select_bancos, 'Seleccione el banco');
        $select_bancos.val(banco_id).trigger('change');
        
        let lista_categorias = '';
        data.categorias.forEach((categoria) => {
          lista_categorias += `<option value="${categoria.id}">${categoria.categoria}</option>`;
        });
        $select_categorias.html(lista_categorias);
        inicializarSelect2($select_categorias, 'Seleccione la categoría');
        $select_categorias.val(categoria_id).trigger('change');
      },
      error: (error)=>{
        toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
      }
    });
  });


	var groupColumn = 1;
  $('#tabla-reporte-ingresos').DataTable({
  	"columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
    "order": [[ groupColumn, 'asc' ]],
    'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
    "dom": 'Blfrtip',
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
        // customize: function( xlsx ) {
        //       var sheet = xlsx.xl.worksheets['sheet1.xml'];
        //       let rels = xlsx.xl.worksheets['sheet1.xml'];
        //       var clR = $('row', sheet); 
              
        //       let nRows = clR.length;//6
        //       let total = $('c[r=F'+nRows+'] t', sheet).text();                
        //       $('row:last c t', sheet).text( '' );
        //       $('c[r=C'+nRows+'] t', sheet).text('TOTAL:' );
        //       $('c[r=C'+nRows+'] t', sheet).attr('s','37');
        //       $('c[r=D'+nRows+'] t', sheet).text( total );
        //       $('c[r=D'+nRows+'] t', sheet).attr('s','37');             
        //     },
        'exportOptions':
        {
          columns:[0,1,2,3,4,5,6]
        }
        //, footer: true
      }],
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
                  "colspan": 2, 
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
                     "colspan": 2, 
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
              //$('#pruebita').val(total);
                      
        });   
    }
  });     

});
function convertDateFormat2(string) {
        var info = string.split('-').reverse().join('/');
        return info;
  }
function inicializarSelect2($select, text) {
  $select.prop('selectedIndex', -1);
  $select.select2({
    placeholder: text,
    allowClear: true,
  });
}
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