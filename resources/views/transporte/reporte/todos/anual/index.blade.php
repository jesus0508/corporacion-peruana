@extends('layouts.main')

@section('title','Reporte Transportes')

@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Reportes</a></li>
  <li><a href="#">Transportes</a></li>
  <li><a href="#">Anual</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('transporte.reporte.todos.anual.header')
  @include('transporte.reporte.todos.anual.table')
  <!--/.end-modales-->
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function() {

  $('#tabla-ingresos-netos-anual').DataTable({
      "responsive": true,
      "dom": 'Blfrtip',
      "iDisplayLength": 50,
      "columnDefs":[
          { targets: [4]  , visible: false  }
        ],
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Ingreso Neto Anual Transportes',
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
              $('c[r=C'+nRows+'] t', sheet).text('TOTAL:' );
              $('c[r=C'+nRows+'] t', sheet).attr('s','37');             
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
            $( api.column( 3 ).footer() ).html( pageTotal );
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
  let $tabla_neto_anual_transporte = $('#tabla-ingresos-netos-anual');
  
  $("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years",
    autoclose: true
  });

  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $('#datepicker').val();
      let cell = data[4];
      if (sInicio) {
        return sInicio === cell;
      }
      return true;
    }
  );

  $("#datepicker").on('change', function () {
     $tabla_neto_anual_transporte.DataTable().draw();
  }); 

  $('#clear-fecha').on('click', function () {
    $('#datepicker').val("");
    $tabla_neto_anual_transporte.DataTable().draw();
    $('#filter-grifo').val('').trigger('change');
  });

 $('#yesterday-fecha1').click(function() {    
    let year = $(this).val();
    $('#datepicker').val(year);
 $tabla_neto_anual_transporte.DataTable().draw();
  });

  $('#yesterday-fecha').click(function() {    
    let year = $(this).val();
    $('#datepicker').val(year);
  $tabla_neto_anual_transporte.DataTable().draw();
  });

  $('#today-fecha').click(function() {    
    let year = $(this).val();  
    $('#datepicker').val(year); 
  $tabla_neto_anual_transporte.DataTable().draw();
  });


}

$(document).ready(function() {
    validateDates();
    let $filter_placa = $('#filter-grifo');
    let $filter_tipo      = $('#filter-tipo')
    let $tabla_neto_anual = $('#tabla-ingresos-netos-anual');
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
    $tabla_neto_anual.DataTable().draw();
  });

  $filter_tipo.on('change', function () {
    $tabla_neto_anual.DataTable().draw();
  });  
} );

</script>

 
@endsection