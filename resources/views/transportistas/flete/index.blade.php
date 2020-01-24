@extends('layouts.main')

@section('title','Transportistas')

@section('styles')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@include('reporte_excel.excel_select2_css')
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

<script src="{{ asset('dist/js/datatables/dataTables.rowsGroup.js') }}"></script>
<!-- para botones datatables -->
@include('reporte_excel.excel_select2_js')
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
          title: 'Flete Transportistas',
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
        {"className": "dt-center", "targets":  [4,5,6,7]  }
        ] ,   
      "responsive": false,
      "scrollX": true,
      //"order": [[4, 'desc']],
      //"ordering": false,
       'rowsGroup':[4,5,6,7],             

      "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        if ( aData[8] ){
          $('td', nRow).css('background-color', '#f7c3c2');          
        }     
      }         
  });
});
</script>
@endsection
