_gastos_grifo@extends('layouts.main')

@section('title','Gastos')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Gastos</a></li>
  <li><a href="#">Reporte General</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-6">
      @include('reportes_gastos_grifo.general.table')      
    </div>   
    <div class="col-md-6">
      @include('reportes_gastos_grifo.general.chart')     
    </div>    
  </div>
  <!--/.end-modales-->
</section>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
 <script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>
 <script src="https://cdn.jsdelivr.net/npm/fusioncharts@3.12.2/fusioncharts.js" charset="utf-8"></script>
  {!! $chart->script() !!}
<script>
$(document).ready(function() {
  $('#tabla-gastos-general').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
          "pagingType": "simple",
      "responsive": true,
      'iDisplayLength': 12,
      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Total over all pages
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
                'S/. '+pageTotal
                // +' (S/.'+ total +' total)'
            );
      }
  });
});
</script> 
@endsection