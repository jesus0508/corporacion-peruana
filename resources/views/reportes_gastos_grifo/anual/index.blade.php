@extends('layouts.main')
@section('title','Reporte General')
@section('styles')
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Reportes</a></li>
  <li><a href="#">Egresos</a></li>
  <li><a href="#">Anual</a></li>

</ol>
@endsection

@section('content')
<section class="content">
  
  @include('reportes_gastos_grifo.anual.filtrado')    
  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#home">Egresos Total Anual</a></li>
        <li><a href="#menu1">Egresos Por Grifo anual</a></li>
      </ul>
      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <div class="row">
            @include('reportes_gastos_grifo.anual.table')
            @include('reportes_gastos_grifo.anual.chart')  
          </div>  
        </div>
        <div id="menu1" class="tab-pane fade">
            @include('reportes_gastos_grifo.anual.table_grifos')
            @include('reportes_gastos_grifo.anual.chart_grifos')  
        </div>
      </div>
    </div>
  </div>


</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js">
</script>
  {!! $chart->script() !!}
  {!! $chart_grifos->script() !!}
<script>

$(document).ready(function() {

  $(".nav-tabs a").click(function(){
    $(this).tab('show');
  });
  $('.nav-tabs a').on('shown.bs.tab', function(event){
    var x = $(event.target).text();         // active tab
    var y = $(event.relatedTarget).text();  // previous tab
    $(".act span").text(x);
    $(".prev span").text(y);
  });

  $("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years",
    autoclose: true
  });

  let year_actual = (new Date).getFullYear();    
  var original_api_url = {{ $chart->id }}_api_url;
  var original_api_url_grifos = {{ $chart_grifos->id }}_api_url;  
  $("#datepicker").change(function(){
    if ($(this).val()) {
      var year = $(this).val();      
      {{ $chart->id }}_refresh(original_api_url + "?year="+year);
      RefreshTable('#tabla-egresos',`./reporte_egresos_grifos_anual_data/${year}`);
      {{ $chart_grifos->id }}_refresh(original_api_url_grifos + "?year="+year);
      RefreshTable('#tabla-grifos-egresos',`./reporte_egresos_x_grifo_anual_data/${year}`);
    }      
  });

  $("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years",
    autoclose: true
  });

  $('#tabla-egresos').DataTable({
      "pageLength": 12,      
      "searching": false,
      "ordering": false,
      "dom": 'Blfrtip',
      'ajax': `./reporte_egresos_grifos_anual_data`,
      'columns': [
        {data: 'mes_year'},     
        {data: 'monto_egreso'}
      ],
      "responsive":  true,
      "buttons": [
          {
            'extend': 'excelHtml5',
            'title': 'Lista Egresos Grifos Anual',
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
              let nRows = clR.length;
              //let total = $('c[r=F'+nRows+'] t', sheet).text();              
              $('row:last c t', sheet).text( '' );
              showExcelSubtotal(sheet,nRows,'B','Total');                                     
            },
            'exportOptions':
            {
              columns:[0,1]
            },
            'footer': true
          }],
          "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                getSubtotal(api,1);
          }     
  });

  $('#tabla-grifos-egresos').DataTable({
      "pageLength": 50,      
      "searching": false,
      "ordering": false,
      "dom": 'Blfrtip',
      'ajax': `./reporte_egresos_x_grifo_anual_data`,
      'columns': [
        {data: 'grifo'},     
        {data: 'monto_egreso'}
      ],
      "responsive":  true,
      "buttons": [
          {
            'extend': 'excelHtml5',
            'title': 'Lista Egresos Anual por Grifo',
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
              let nRows = clR.length;
              //let total = $('c[r=F'+nRows+'] t', sheet).text();              
              $('row:last c t', sheet).text( '' );
              showExcelSubtotal(sheet,nRows,'B','Total');                                     
            },
            'exportOptions':
            {
              columns:[0,1]
            },
            'footer': true
          }],
          "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                getSubtotal(api,1);
          }     
  });
  $('#yesterday-fecha1').click(function() {    
    let year = year_actual -2 ;
      $("#datepicker").val(year);
      {{ $chart->id }}_refresh(original_api_url + "?year="+year);
      RefreshTable('#tabla-egresos',`./reporte_egresos_grifos_anual_data/${year}`);
      {{ $chart_grifos->id }}_refresh(original_api_url_grifos + "?year="+year);
      RefreshTable('#tabla-grifos-egresos',`./reporte_egresos_x_grifo_anual_data/${year}`);
  });

  $('#yesterday-fecha').click(function() {    
    let year = year_actual -1 ;
      $("#datepicker").val(year);
      {{ $chart->id }}_refresh(original_api_url + "?year="+year);
      RefreshTable('#tabla-egresos',`./reporte_egresos_grifos_anual_data/${year}`);
      {{ $chart_grifos->id }}_refresh(original_api_url_grifos + "?year="+year);
      RefreshTable('#tabla-grifos-egresos',`./reporte_egresos_x_grifo_anual_data/${year}`);
  });

  $('#today-fecha').click(function() {    
    let year= year_actual; 
    $("#datepicker").val(year);
      {{ $chart->id }}_refresh(original_api_url + "?year="+year);
      RefreshTable('#tabla-egresos',`./reporte_egresos_grifos_anual_data/${year}`);
      {{ $chart_grifos->id }}_refresh(original_api_url_grifos + "?year="+year);
      RefreshTable('#tabla-grifos-egresos',`./reporte_egresos_x_grifo_anual_data/${year}`);
  });

  $('#today-fecha1').click(function() {    
    let year= year_actual+1; 
    $("#datepicker").val(year);
      {{ $chart->id }}_refresh(original_api_url + "?year="+year);
      RefreshTable('#tabla-egresos',`./reporte_egresos_grifos_anual_data/${year}`);
      {{ $chart_grifos->id }}_refresh(original_api_url_grifos + "?year="+year);
      RefreshTable('#tabla-grifos-egresos',`./reporte_egresos_x_grifo_anual_data/${year}`);
  });

});

 function showExcelSubtotal(sheet,nRows,letter,text){
    $('c[r='+letter+nRows+'] t', sheet).text(text);
    $('c[r='+letter+nRows+'] t', sheet).attr('s','37');//Negrita
  }

  function getSubtotal(api,column){
    pageTotal = api
                .column( column, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2); 
            // Update footer
            $( api.column( column ).footer() ).html(
                pageTotal
                // +' (S/.'+ total +' total)'
            );

  }

  function RefreshTable(tableId, urlData){
    $.getJSON(urlData, null, function( json ){
      table = $(tableId).dataTable();
      oSettings = table.fnSettings();
      table.fnClearTable(this);    
      for (var i=0; i<json.data.length; i++) {
        table.oApi._fnAddData(oSettings, json.data[i]);       
      } 
      oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();      
      table.fnDraw();
   
    });
  }
</script>
@endsection