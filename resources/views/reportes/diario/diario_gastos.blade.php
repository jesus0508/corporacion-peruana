@extends('layouts.main')

@section('title','Gastos')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Gastos</a></li>
  <li><a href="#">Gestion</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('reportes.diario.filtrado')
  @include('reportes.diario.table')

  <!--/.end-modales-->
</section>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
$(document).ready(function() {
  $('#tabla-gastos-diarios').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "responsive": true,

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Total over all pages
            total = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
 
            // Update footer
            $( api.column( 6 ).footer() ).html(
                'S/. '+pageTotal
                // +' (S/.'+ total +' total)'
            );
      }
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
function ayerFecha(){
    var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();
        dd -= 1;
        dd = addZero(dd);
        mm = addZero(mm);

        return dd+'/'+mm+'/'+yyyy;
}

function hoyFecha(){
    var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();

        dd = addZero(dd);
        mm = addZero(mm);

        return dd+'/'+mm+'/'+yyyy;
}
function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}

function validateDates() {
  let $tabla_pagos_lista = $('#tabla-gastos-diarios');
 
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
      var dia = $.datepicker.parseDate('d/m/yy', data[5]);
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

  $('#today-fecha').on('click', function () {
    let hoy = hoyFecha();
    console.log(hoy);
    $('#fecha_inicio').val(hoy);
    $('#fecha_fin').val(hoy);
    $tabla_pagos_lista.DataTable().draw();
  });
  $('#yesterday-fecha').on('click', function () {
   let ayer = ayerFecha();
    console.log(ayer);
    $('#fecha_inicio').val(ayer);
    $('#fecha_fin').val(ayer);
    $tabla_pagos_lista.DataTable().draw();
  });


}

$(document).ready(function() {
    validateDates();
    let $filter_proveedor = $('#filter-grifo');
    let $tabla_pedido_proveedores = $('#tabla-gastos-diarios');
    inicializarSelect2($filter_proveedor, 'Ingrese el grifo', '');
      $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      let grifo = $filter_proveedor.find('option:selected').text();
      let cell = data[1];
      if (grifo) {
        return grifo === cell;
      }
      return true;
    }

  );

  $filter_proveedor.on('change', function () {
    $tabla_pedido_proveedores.DataTable().draw();
  });


} );

</script>
</script>
 
@endsection