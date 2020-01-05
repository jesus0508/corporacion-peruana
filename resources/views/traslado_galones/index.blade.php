@extends('layouts.main')

@section('title','Traspaso')

@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Registro </a></li>
</ol>
@endsection


@section('content')
<section class="content">
  @include('traslado_galones.create')
  @include('traslado_galones.table')
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
  let $input_user_edit = $('#input-user-edit');
  let $tipo = $('#tipo');
  let $stock = $('#stock');
  let $clienteOrGrifo= $('#select_grifos');
  $('#fecha').datepicker();
$(document).ready(function() {

  $tipo.on('change', function(event){
    console.log(event.currentTarget.value);
    let tipo = $tipo.val();
    if (Number(tipo)!==-1) {
      if (tipo==1) {//grifos
        $clienteOrGrifo.empty();
        fillSelectGrifos();
        $clienteOrGrifo.attr('name','grifo_id');
        console.log('grifos');
      }else{//clientes
        $clienteOrGrifo.empty();
        fillSelectClientes();
        $stock.val('0');
        $clienteOrGrifo.attr('name','cliente_id');
        console.log('clientes');
      }    
    }else{
      $clienteOrGrifo.empty();
    }

  });
  $input_user_edit.on('keyup', function (event) {
    let $cantidad = Number($('#cantidad').val());
    let $stock = Number($('#stock').val());
    let $stock_resultante=$stock+$cantidad;
    $('#nuevo_stock').val($stock_resultante);

  });
	  $('#tabla-traslado-galones').DataTable({
        "language": {
          "lengthMenu": 'Display <select>'+
            '<option value="10">10</option>'+
            '<option value="20">20</option>'+
            '<option value="30">30</option>'+
            '<option value="40">40</option>'+
            '<option value="50">50</option>'+
            '<option value="-1">All</option>'+
            '</select> records'
        },
      "responsive": true, 
     // "scrollX": true,
       "dom": 'Bfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Progamación para Pedidos',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default',
        'exportOptions':
        {
          columns:[1,2,3,4,5,6,7,8]
        }
      }]
    });
});
  function fillSelectGrifos() {
    getAllGrifos()
      .done((data) => {
      //  console.log(data);
        $clienteOrGrifo.html('');
        inicializarSelect2($clienteOrGrifo, 'Seleccione el grifo', data.grifos);
        //llenado de series
        let id = $clienteOrGrifo.val();
        id = (id)?id:-1;   
        fillGrifo(id);
        //evaluateSeries();//evalua valor series         
      })
      .fail((error) => {
        toastr.error('Ocurrió un error', 'Error Alert', { timeOut: 2000 });
      });
  }
   function fillSelectClientes() {
    getAllClientes()
      .done((data) => {
        console.log(data);
        $clienteOrGrifo.html('');
        inicializarSelect2($clienteOrGrifo, 'Seleccione el cliente', data.clientes);   
      })
      .fail((error) => {
        toastr.error('Ocurrió un error', 'Error Alert', { timeOut: 2000 });
      });
  }

function fillGrifo(idGrifo){
    getGrifoById(idGrifo).done((data) => {     
    //$series.val(data.series_grifo);
    $stock.val(data.grifo.stock);
    console.log('stock: ',data.grifo.stock);
    //evaluateSeries();
    }).fail((error) => {
      toastr.error('Ocurrio un error en el servidor!', 'Error Alert', { timeOut: 2000 });
    });
}
function getAllGrifos() {
  return $.ajax({
      type: 'GET',
      url: `../grifos_all`,
      dataType: 'json',
    });
  }
function getAllClientes() {
  return $.ajax({
      type: 'GET',
      url: `../clientes_all`,
      dataType: 'json',
    });
  }
function inicializarSelect2($select, text, data) {
    $select.select2({
      placeholder: text,
      data: data
    });
  }
function getGrifoById(idGrifo) {
    return $.ajax({
      type: 'GET',
      url: `../grifos/${idGrifo}`,
      dataType: 'json',
    });
  }
function validateDates() {
 
  let $tabla_traslado_galones = $('#tabla-traslado-galones');
  $('#fecha_inicio').datepicker();
  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $('#fecha_inicio').val();
      var inicio = $.datepicker.parseDate('d/m/yy', sInicio); 
      var dia = $.datepicker.parseDate('d/m/yy', data[1]);
      if (!inicio || !dia || inicio == dia) {
        return true;
      }
      return false;
    }
  );

  $('#filtrar-fecha').on('click', function () {
    console.log('aea');
    $tabla_traslado_galones.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $tabla_traslado_galones.DataTable().draw();
  });
}
$(document).ready(function() {
  validateDates();
});


</script>
@endsection
