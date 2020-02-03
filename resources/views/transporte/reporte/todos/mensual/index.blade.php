@extends('layouts.main')

@section('title','Reporte Transportes')

@section('styles')
@include('reporte_excel.excel_select2_css')
  <style>
  .ui-datepicker-calendar {
      display: none;
  }
  </style>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Reportes</a></li>
  <li><a href="#">Transportes</a></li>
  <li><a href="#">Mensual</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('transporte.reporte.todos.mensual.header')
  @include('transporte.reporte.todos.mensual.table')
  <!--/.end-modales-->
</section>
@endsection


@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {
  $('#tabla-ingresos-netos-mensual').DataTable({
      "responsive": true,
      "dom": 'Blfrtip',
      "iDisplayLength": 50,
      "columnDefs":[
        { targets: [4]  , visible: false  }
      ],
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Ingreso Neto Mensual Transportes',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default',
        customize: function( xlsx ) {
              var sheet = xlsx.xl.worksheets['sheet1.xml'];
              let rels = xlsx.xl.worksheets['sheet1.xml'];
              var clR = $('row', sheet); 
              
              let nRows = clR.length;//6
              let total = $('c[r=F'+nRows+'] t', sheet).text();                
              $('row:last c t', sheet).text( '' );
              $('c[r=D'+nRows+'] t', sheet).text('TOTAL:' );
              $('c[r=D'+nRows+'] t', sheet).attr('s','37');
              $('c[r=E'+nRows+'] t', sheet).text( total );
              $('c[r=E'+nRows+'] t', sheet).attr('s','37');             
            },
        'exportOptions':
        {
          columns:[0,1,2,3]
        },
        footer: true
      }], 

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);
            // Update footer
            $( api.column( 3 ).footer() ).html(  pageTotal  );
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

function validateDates() {
  let $tabla_neto_mensual_transporte = $('#tabla-ingresos-netos-mensual');
  $('#fecha_inicio').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
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
      let cell = data[4];
      if (sInicio) {
        return sInicio === cell;
      }
      return true;
    }
  );

  $('#filtrar-fecha').on('click', function () {
    $tabla_neto_mensual_transporte.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $tabla_neto_mensual_transporte.DataTable().draw();
    $('#filter-grifo').val('').trigger('change');
  });

  $('#today-fecha').on('click', function () {
    let hoy = $('#month_actual_date').val();
    $('#fecha_inicio').val(hoy);
    $tabla_neto_mensual_transporte.DataTable().draw();
  });
  $('#yesterday-fecha').on('click', function () {
    let ayer = $('#last_month_date').val();
    $('#fecha_inicio').val(ayer);
    $tabla_neto_mensual_transporte.DataTable().draw();
  });


}

$(document).ready(function() {
    validateDates();
    let $filter_placa = $('#filter-grifo');
    let $filter_tipo      = $('#filter-tipo'); 
    let $tabla_neto_mensual = $('#tabla-ingresos-netos-mensual');
    inicializarSelect2($filter_tipo, 'Tipo', '');    
    inicializarSelect2($filter_placa, 'Placa', '');
    //placa filter
    $.fn.dataTable.ext.search.push(
      function (settings, data, dataIndex) {
        let placa = $filter_placa.find('option:selected').text();
        let cell = data[2];
        if (placa) {
          return placa === cell;
        }
        return true;
    });
    //tipo filter  
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
      let tipo = $filter_tipo.find('option:selected').text();
      let cell = data[1];
      if (tipo) {
        return tipo === cell;
      }
      return true;
    }); 

  $filter_placa.on('change', function () {
    $tabla_neto_mensual.DataTable().draw();
  });

  $filter_tipo.on('change', function () {
    $tabla_neto_mensual.DataTable().draw();
  });  
} );

</script>

 
@endsection