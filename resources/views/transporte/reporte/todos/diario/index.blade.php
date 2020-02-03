@extends('layouts.main')

@section('title','Reporte Transportes')

@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Reportes</a></li>
  <li><a href="#">Transportes</a></li>
  <li><a href="#">Diario</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('transporte.reporte.todos.diario.header')
  @include('transporte.reporte.todos.diario.table')
  <!--/.end-modales-->
</section>
@endsection


@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {

  $('#tabla-netos-unidades-diario').DataTable({
      "responsive": true,
      "dom": 'Blfrtip',
      "iDisplayLength": 50,
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Ingreso Neto Diario Transporte',
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
              $('c[r=D'+nRows+'] t', sheet).text('TOTAL NETO:' );
              $('c[r=D'+nRows+'] t', sheet).attr('s','37');
              $('c[r=E'+nRows+'] t', sheet).text( total );
              $('c[r=E'+nRows+'] t', sheet).attr('s','37');             
            },
        'exportOptions':
        {
          columns:[0,1,2,3,4]
        },
        footer: true
      }], 

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Total over this page
            pageTotal = api
                .column(4 , { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);
            $( api.column( 4 ).footer() ).html(pageTotal);
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
  let $tabla_ingresos_diario = $('#tabla-netos-unidades-diario');
  $('#fecha_inicio').datepicker();
  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $('#fecha_inicio').val();
      //console.log(sInicio,data[0]);
      let cell = data[0];
      if (sInicio) {
        return sInicio === cell;
      }
      return true;
    }
  );

  $('#filtrar-fecha').on('click', function () {
    $tabla_ingresos_diario.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $tabla_ingresos_diario.DataTable().draw();
    $('#filter-grifo').val('').trigger('change');
    $('#filter-tipo').val('').trigger('change');
  });
}

$(document).ready(function() {
    validateDates();
    let $filter_placa = $('#filter-grifo');
    let $filter_tipo      = $('#filter-tipo'); 
    let $tabla_transportistas_diario_total = $('#tabla-netos-unidades-diario');
    inicializarSelect2($filter_placa, 'Elija la placa', '');
    inicializarSelect2($filter_tipo, 'Tipo', '');   
    //placa
    $.fn.dataTable.ext.search.push(
      function (settings, data, dataIndex) {
        let placa = $filter_placa.find('option:selected').text();
        let cell = data[2];
        if (placa) {
          return placa === cell;
        }
      return true;
    });
    //tipo
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
      let tipo = $filter_tipo.find('option:selected').text();
      let cell = data[3];
      if (tipo) {
        return tipo === cell;
      }
      return true;
    }); 
  $filter_placa.on('change', function () {
    $tabla_transportistas_diario_total.DataTable().draw();
  });  
  $filter_tipo.on('change', function () {
    $tabla_transportistas_diario_total.DataTable().draw();
  }); 

} );

</script>

 
@endsection