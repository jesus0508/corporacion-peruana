@extends('layouts.main')

@section('title','Grifos')

@section('styles')
  @include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Grifos</a></li>
  <li><a href="#">Gestion</a></li>
  <li><a href="#">Balancear</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include('grifos.balanceo.header')
  @include('grifos.balanceo.body')
  @include('grifos.balanceo.table')

</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>

$(document).ready(function() {

	$('#tabla-grifos-balance').DataTable({
      "responsive": false,
      "scrollY": true,
        "aaSorting": [],
      "dom": 'Blfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Historial balanceos',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default',
        'exportOptions':
        {
          columns:[0,1,2,3,4,5]
        }
      }],
	});
});

	let $select_grifo1 = $('#grifo_a_quitar');
	let $select_grifo2 = $('#grifo_a_dar'); 
	let $stock_actual1 = $('#stock_actual1');
	let $stock_actual2 = $('#stock_actual2');
	let $stock_nuevo1  = $('#stock_nuevo1');
	let $stock_nuevo2  = $('#stock_nuevo2');
	let $galones       = $('#galones');
	let $input_user    = $('#input_user');

$(document).ready(function() {

	$select_grifo1.prop('selectedIndex', -1);
	$select_grifo1.select2({
		placeholder: 'Seleccione un grifo ',
		allowClear: true
		});
	$select_grifo2.prop('selectedIndex', -1);
	$select_grifo2.select2({
		placeholder: 'Seleccione un grifo ',
		allowClear: true
	});

	$galones.on('keyup', function (event){
		let galones = $galones.val();
		let grifo1_id = $select_grifo1.val();
		let grifo2_id = $select_grifo2.val(); 

		if(grifo1_id!=null){
			if (grifo2_id!=null) {
				galones   = (galones)? parseFloat( galones ): 0.00;
				let stock_actual1 = $stock_actual1.val();
				let stock_actual2 = $stock_actual2.val();				
				let stock_nuevo1 = stock_actual1 - galones;
				let stock_nuevo2 = parseFloat(stock_actual2) + parseFloat(galones);
				$stock_nuevo1.val(stock_nuevo1);
				$stock_nuevo2.val(stock_nuevo2);
			}			
		}

	});


	$select_grifo1.on('change', function (event){
		let galones = $galones.val();
		let grifo1_id = $select_grifo1.val();
		let grifo2_id = $select_grifo2.val(); 
		if(grifo1_id!=null){
			fillGrifo(grifo1_id,1); 
		}else{
			$galones.val('');
			$stock_actual1.val('');
		}
	});

	$select_grifo2.on('change', function (event){
		let galones = $galones.val();
		let grifo1_id = $select_grifo1.val();
		let grifo2_id = $select_grifo2.val(); 
		if(grifo2_id!=null){
			fillGrifo(grifo2_id,2); 
		}else{
			$galones.val('');
			$stock_actual2.val('');
		}
	});

 validateDates();
});

	function validateDates(){

	let $tabla_historial_balance = $('#tabla-grifos-balance');
 
		$('#fecha_inicio').datepicker({
	    numberOfMonths: 2,
	    onSelect: function (selected) {
	      $('#fecha_fin').datepicker('option', 'minDate', selected)
	    }
	  });
	  $('#fecha_fin').datepicker({
	    numberOfMonths: 2,
	    onSelect: function (selected) {
	      $('#fecha_inicio').datepicker('option', 'maxDate', selected)
	    }
	  });

  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $('#fecha_inicio').val();
      var sFin = $('#fecha_fin').val();
      var inicio = $.datepicker.parseDate('d/m/yy', sInicio);
      var fin = $.datepicker.parseDate('d/m/yy', sFin);
      var dia = $.datepicker.parseDate('d/m/yy', data[0]);
      if (!inicio || !dia || fin >= dia && inicio <= dia) {
        return true;
      }
      return false;
    }
  );

  $('#filtrar-fecha').click(function() {
    $tabla_historial_balance.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $('#fecha_fin').val("");
    $tabla_historial_balance.DataTable().draw();
  });

}

  function fillGrifo(idGrifo,tipo){
    getGrifoById(idGrifo).done((data) => {  
	    if (tipo==1) {
	    	$stock_actual1.val(data.grifo.stock);
	    	$stock_nuevo1.val(data.grifo.stock);
	    	let grifo1_id = $select_grifo1.val(); 
	    	let grifo2_id = $select_grifo2.val(); 
	/*---------   datos grifo1      --------------*/
				if (grifo2_id!=null) {
					if (grifo1_id!=grifo2_id) {
						galones   = (galones)? parseFloat( galones ): 0.00;
						let stock_actual1 = $stock_actual1.val();
						let stock_actual2 = $stock_actual2.val();				
						let stock_nuevo1 = stock_actual1 - galones;
						let stock_nuevo2 = parseFloat(stock_actual2) + parseFloat(galones);
						$stock_nuevo1.val(stock_nuevo1);
						$stock_nuevo2.val(stock_nuevo2);
					}else{//mismo grifo escogido
						let stock_actual1 = $stock_actual1.val();
						let stock_actual2 = $stock_actual2.val();	
						$stock_nuevo1.val(stock_actual1);
						$stock_nuevo2.val(stock_actual2);
						toastr.warning('Escoja grifos diferentes!', 'Warning Alert', { timeOut: 2000 });
					}

				}

	    } else{
				$stock_actual2.val(data.grifo.stock);
	    	$stock_nuevo2.val(data.grifo.stock);

				let galones = $galones.val();
	    	let grifo1_id = $select_grifo1.val(); 
				let grifo2_id = $select_grifo2.val(); 
	/*---------   datos grifo2      --------------*/
				if (grifo1_id!=null) {
					if (grifo1_id!=grifo2_id) {
						galones   = (galones)? parseFloat( galones ): 0.00;
						let stock_actual1 = $stock_actual1.val();
						let stock_actual2 = $stock_actual2.val();				
						let stock_nuevo1 = stock_actual1 - galones;
						let stock_nuevo2 = parseFloat(stock_actual2) + parseFloat(galones);
						$stock_nuevo1.val(stock_nuevo1);		
						$stock_nuevo2.val(stock_nuevo2);	
					}	else{
						let stock_actual1 = $stock_actual1.val();
						let stock_actual2 = $stock_actual2.val();	
						$stock_nuevo1.val(stock_actual1);
						$stock_nuevo2.val(stock_actual2);
						toastr.warning('Escoja grifos diferentes!', 'Warning Alert', { timeOut: 2000 });
					}
				}

	    }  

    }).fail((error) => {
      toastr.error('Ocurrio un error en el servidor!', 'Error Alert', { timeOut: 2000 });
    });
  }
  function getGrifoById(idGrifo) {
    return $.ajax({
      type: 'GET',
      url: `./grifos/${idGrifo}`,
      dataType: 'json',
    });
  }

</script>   
@endsection