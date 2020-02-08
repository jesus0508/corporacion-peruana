@extends('layouts.main')

@section('title','Reporte')

@section('styles')
@include('reporte_excel.excel_select2_css')
<style>
  table td{
    vertical-align : middle!important;
    text-align:center!important;
  }

  .scroll {
      width: auto;
      overflow-x: auto;
      white-space: nowrap;
  }
</style>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Pedidos</a></li>
  <li><a href="#">Distribución Combustible</a></li>
</ol>
@endsection

@section('content')

<section class="content">

  @include('pedidosP.reporte_combustible.header')
   <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">          <!-- /.box-header -s-->
        <div class="box-body" >
          <div class="scroll">
             @include('pedidosP.reporte_combustible.table',$pedidos)
          </div>         
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
</section>


@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {
  $filter_scop                = $('#filter-scop');
  $filter_fecha               = $('#filter-fecha');
  $tabla_reporte_distribucion = $('#distribucion');
  $btn_find                   = $('#button-find');
  $btn_clear                  = $('#clear-fecha');
  $btn_export                 = $('#button-export');

	$filter_fecha.datepicker();
  $filter_scop.prop('selectedIndex', -1);
  $filter_scop.select2({
    placeholder: "Seleccione el SCOP",
    allowClear: true
  });

  $btn_export.click(function(){
      let currentURL       = window.location.href;
      let pedacitos        = currentURL.split('/').reverse();
      let posicionIdPedido = 0;
      let posicionFecha    = 1;

      let idPedido = pedacitos[posicionIdPedido];
      let fecha = pedacitos[posicionFecha];

      window.location.href = `../../reporte_pedidos_combustible_export/${fecha}/${idPedido}`;
  
  });

  $btn_find.click(function(){
    idPedido = $filter_scop.val();
    idPedido = (idPedido)?idPedido:0;
    fecha = $filter_fecha.val();    
    fecha = convertDateFormat(fecha);
    fecha = (fecha)?fecha:-1;
    window.location.href = `../../reporte_pedidos_combustible/${fecha}/${idPedido}`;
  });

  $btn_clear.click(function(){
    $filter_fecha.val('');
    $filter_scop.val('').trigger('change');
  });

});
  function convertDateFormat(string) {
        var info = string.split('/').reverse().join('-');
        return info;
  }

</script>
@endsection