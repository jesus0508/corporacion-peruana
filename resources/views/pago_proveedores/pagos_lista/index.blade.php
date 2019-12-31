@extends('layouts.main')
@section('title','Pagos')
@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="#">Pagos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('pago_proveedores.pagos_lista.buttons')
  @include('pago_proveedores.pagos_lista.table')
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {    
    $('#tabla-pagos_lista').DataTable({
      "order": [[ 0, "desc" ]],       
      "responsive": true,             
      "dom": 'Blfrtip',
      "buttons": [
        {
          extend: 'excelHtml5',
          title: 'Lista Pagos Proveedor',
          attr:  {
                title: 'Excel',
                id: 'excelButton'
            },
          text:     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
          className: 'btn btn-default',
          exportOptions:
            {
              columns:[1,2,3,4,5]
            }

         }
        ],

      columnDefs: [ 
    { 
      orderable: false, 
      targets: [ -1 ] 
    },
    { 
      searchable: false, 
      targets: [-1] 
    },
              
      { responsivePriority: 1, targets: [1,-1] }
    ] 
   
    });
   
});
function inicializarSelect2($select, text, data) {
  $select.prop('selectedIndex', -1);
  $select.select2({
    placeholder: text,
    allowClear: true,
    data: data
    });
  }
function validateDates() {
  let $tabla_pagos_lista = $('#tabla-pagos_lista');
 
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
      var dia = $.datepicker.parseDate('d/m/yy', data[2]);
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
    let $filter_proveedor = $('#filter-proveedor');
    let $tabla_pedido_proveedores = $('#tabla-pagos_lista');
    inicializarSelect2($filter_proveedor, 'Ingrese el proveedor', '');
      $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      let proveedor = $filter_proveedor.find('option:selected').text();
      let cell = data[1];
      if (proveedor) {
        return proveedor === cell;
      }
      return true;
    }

  );

  $filter_proveedor.on('change', function () {
    $tabla_pedido_proveedores.DataTable().draw();
  });


} );

</script>
@endsection