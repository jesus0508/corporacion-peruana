@extends('layouts.main')

@section('title','Empresa')

@section('styles')
  @include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Empresa</a></li>
  <li><a href="#">Gastos Gerencia</a></li>
  <li><a href="#">Pago Gastos Gerencia</a></li> 
  <li><a href="#">Confirmación</a></li> 

</ol>
@endsection


@section('content')
<section class="content">
  <form class="" action="{{route('egreso_gerencia.storePagoEgreso')}}" method="post">
  @csrf
  @method('post')
    @include('empresa.egresos_gerencia.pago.create')
    @include('empresa.egresos_gerencia.pago.table')
  </form>    
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {
  
  let $tabla = $('#tabla-egreso-gerencia');
  let $fecha = $('#fecha_egreso')
  inicializarDataTable($tabla);
  $fecha.datepicker();

});

function inicializarDataTable($table){  
	 $table.DataTable({
      "responsive": false,
      "searching": false,
      'orderable': false,
      "paginate": false,
      //"dom": 'Blfrtip',
      "scrollX": true,
      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // pageTotal = api
            //     .column( 4, { page: 'current'} )
            //     .data()
            //     .reduce( function (a, b) {
            //           return Number(a) + Number(b);
            //     }, 0 );
            // pageTotal = pageTotal.toFixed(2);
            // $( api.column( 4 ).footer() ).html(pageTotal);
            pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2);
            $( api.column( 6 ).footer() ).html(pageTotal);
      }
  });

}


</script>
@endsection
