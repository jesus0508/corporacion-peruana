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
  <li><a href="#">Reporte Anual</a></li>
</ol>
@endsection

@section('content')
<section class="content">

  @include('reportes_gastos_grifo.anual.filtrado')

  <div class="row">
    <div class="col-md-6">  
     @include('reportes_gastos_grifo.anual.table')      
    </div>   

    <div class="col-md-6">
      @include('reportes_gastos_grifo.anual.chart')       
    </div>    
  </div>

  <!--/.end-modales-->
</section>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
  {!! $chart->script() !!}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>
 <script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

<script>
$(document).ready(function() {

$("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years",
    autoclose: true
});
  $('#tabla-gastos-anual').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "responsive": true,
      'iDisplayLength': 12,
      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);
            // Update footer
            $( api.column( 3 ).footer() ).html(
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

$(document).ready(function() {

    let $filter_proveedor = $('#fecha_inicio');
    let $tabla_pedido_proveedores = $('#tabla-gastos-anual');
    inicializarSelect2($filter_proveedor, 'Ingrese Año', '');
      $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      let anio = $filter_proveedor.find('option:selected').text();
      let cell = data[1];
      if (anio) {
        return anio === cell;
      }
      return true;
    }  

    );

  $('#today-fecha').on('click', function () {
    $('#fecha_inicio').val('2019').trigger('change');
    $tabla_pedido_proveedores.DataTable().draw();
  });

  $('#today-fecha1').on('click', function () {
    $('#fecha_inicio').val('2020').trigger('change');
    $tabla_pedido_proveedores.DataTable().draw();
  });

  $('#today-fecha2').on('click', function () {
    $('#fecha_inicio').val('2021').trigger('change');
    $tabla_pedido_proveedores.DataTable().draw();
  });

  $('#yesterday-fecha').on('click', function () {
    $('#fecha_inicio').val('2018').trigger('change');
    $tabla_pedido_proveedores.DataTable().draw();
  });

$('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val('').trigger('change');
    $tabla_pedido_proveedores.DataTable().draw();
  });



  $filter_proveedor.on('change', function () {
    $tabla_pedido_proveedores.DataTable().draw();
  });


} );
var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
</script>
 
@endsection