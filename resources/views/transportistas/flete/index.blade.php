@extends('layouts.main')

@section('title','Transportistas')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css"></link> 
<link src="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css"></link> 
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet"></link> 
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Transportistas</a></li>
  <li><a href="#">Flete Pedidos</a></li>
</ol>
@endsection

@section('content')

<section class="content">
	@include('transportistas.flete.buttons_top')
  @include('transportistas.flete.table_fletes')
  @include('transportistas.flete.modal_pagar')
</section>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="//cdn.rawgit.com/ashl1/datatables-rowsgroup/v1.0.0/dataTables.rowsGroup.js"></script> 
<!-- para botones datatables -->
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> -->
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<!-- para botones datatables - end -->
<script>
$(document).ready(function() {

function inicializarSelect2($select, text, data) {
  $select.prop('selectedIndex', -1);
  $select.select2({
    placeholder: text,
    allowClear: true,
    data: data
    });
  }
function validateDates() {
  let $tabla_flete_pedidos = $('#tabla-flete-pedidos');
 
  $('#fecha_inicio').datepicker({
    numberOfMonths: 2,
    onSelect: function (selected) {
      $('#fecha_fin').datepicker('option', 'minDate', selected)
    }
  });
  $('#fecha_fin').datepicker({
    numberOfMonths: 2,
    onSelect: function (selected) {
      $('#fecha_inicio').datepicker('option', 'maxDate', selected)
    }
  });

  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $('#fecha_inicio').val();
      var sFin = $('#fecha_fin').val();
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
    $tabla_flete_pedidos.DataTable().draw();
  });
  
  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $('#fecha_fin').val("");
    $tabla_flete_pedidos.DataTable().draw();
  });

}

$(document).ready(function() {
    validateDates();
    let $filter_transportista = $('#filter-transportista');
    let $tabla_pedido_proveedores = $('#tabla-flete-pedidos');
    inicializarSelect2($filter_transportista, 'Ingrese el transportista', '');
      $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      let transportista = $filter_transportista.find('option:selected').text();
      let cell = data[5];
      if (transportista) {
        return transportista === cell;
      }
      return true;
    }

  );

  $filter_transportista.on('change', function () {
    $tabla_pedido_proveedores.DataTable().draw();
  });

} );





    $("#modal-pagar-transportista").on("show.bs.modal", function(event) {      
    $.get('faltante/create', function( data ) {
        var html = "";
        console.log(data);
        data.forEach(function(val) {
          var keys = Object.keys(val);
          var prueba = 'futuro valor para saber si hay deuda con el proveedor';
          console.log(val);
        //  console.log(band);
          if( val != null ){ 
            html +='<div class="row">';
            html +=  '<div class="col-md-2"></div>';
            html +=  '<div class="col-md-8">';
            if ( prueba != null) {
                          html +=    '<a href="faltante/'+val['id']+'" class="btn  btn-block btn-lg btn-primary">'+val['nombre_transportista'];
            html +=    '</a> ';
            }
            html +=  '</div>';
            html +=  ' <div class="col-md-2"></div>';
            html +='</div>';
            html +='<p></p>';         
            $(".show-transportistas").html(html);
          }
        });     
    });   
  });


  $('#tabla-flete-pedidos').DataTable({ 
      "dom": 'Blfrtip',
      "buttons": [
        {
          extend: 'excelHtml5',
          title: 'Programación Flete Transportistas',
          attr:  {
                title: 'Excel',
                id: 'excelButton'
            },
          text:     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
          className: 'btn btn-default',
          exportOptions:
            {
              columns:[0,1,2,3,4,5,6]
            }

         }],
      "columnDefs": [
        { "visible": false, "targets": 8 },
        {"className": "dt-center", "targets":  [4]  }
        ] ,
      "order": [[4, 'desc']],
     // "ordering": false,
       'rowsGroup':[4], 
       // "rowGroup": {  dataSrc: 4 } ,
      "responsive": true,             
      'language': {
        'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
      },

      "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        if ( aData[8] ){
          $('td', nRow).css('background-color', '#f7c3c2');          
        }     
      }         
  });
});
</script>
@endsection
