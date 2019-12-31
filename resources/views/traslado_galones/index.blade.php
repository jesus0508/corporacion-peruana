@extends('layouts.main')

@section('title','Traspaso')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet"></link>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
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
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "responsive": false, 
      "scrollX": true,
    });
});
  function fillSelectGrifos() {
    getAllGrifos()
      .done((data) => {
        console.log(data);
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
  console.log('entro a validate');
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
