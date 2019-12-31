@extends('layouts.main')
@section('title','Pagos')
@section('styles')
<link rel="stylesheet" href="{{asset('dist/css/datatables/dataTables.checkboxes.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Transportistas</a></li>
  <li><a href="#">Fletes</a></li>
  <li><a href="#">Pago Transportistas</a></li>
</ol>
@endsection

@section('content')

<section class="content">
	<form id="frm-example" action="{{route('faltante.store')}}" method="post" >
    @csrf
  	@include('pago_transportistas.pago_fletes_selected.header')
  	@include('pago_transportistas.pago_fletes_selected.table')
	</form>
</section>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/datatables/dataTables.rowsGroup.js') }}"></script>
<script src="{{ asset('dist/js/datatables/dataTables.checkboxes.min.js') }}"></script>
<script> 
$(document).ready(function(){
	var montoFlete = 0;
	let $table = $('#tabla-pago-select').DataTable({
      'columnDefs': [
         {
            'targets': 0,
            'checkboxes': true
         }
      ],
      'order': [[1, 'asc']]
  });
  
  let rows_selected = $table.column(0).checkboxes.selected();
  montoFlete=0;
  $.each(rows_selected, function(index, rowId){  
    let arrayRow = rowId.split("-");
    let plus = arrayRow[1];
    montoFlete += Number(plus);
  });
  $('#montoFlete').val(montoFlete);
 
	$('#calcMontoFlete').on('click', function(e){
		e.preventDefault();
      let rows_selected = $table.column(0).checkboxes.selected();
      montoFlete=0;
      $.each(rows_selected, function(index, rowId){  
        let arrayRow = rowId.split("-");
        let plus = arrayRow[1];
        montoFlete += Number(plus);
      });
      $('#montoFlete').val(montoFlete);
 
	});
	$('#frm-example').on('submit', function(e){
      let form = this;
      let rows_selected = $table.column(0).checkboxes.selected();
      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){//index -> row[index]
         // Create a hidden element	// rowId -> id del Pedido
         let arrayRow = rowId.split("-");
         let idPedido = arrayRow[0];
         montoFlete = arrayRow[1];
         console.log(montoFlete);
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(idPedido)
         );
      });
   });
});	 
</script>
@endsection