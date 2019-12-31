@extends('layouts.main')

@section('title','Venta Facturada')
@section('styles')
  @include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{route('grifos.index')}}">Grifos</a></li>
  <li><a href="#">Facturacion Venta Grifo</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include( 'stock_grifos.header' )
  @include('stock_grifos.create') 
 {{--@include('stock_grifos.table')--}}
 <!--  modal -->
 {{--@include('stock_grifos.modal_edit')--}}
 <!--  end modal -->
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>

$(document).ready(function() {
  $('#tabla-factura-grifos').DataTable({
       "columnDefs": [{
                "targets": [ 7 ],
                "visible": false
            }],
      "responsive": true,
      "searching":true,
      "dom": 'Blfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Stock Grifo',
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
              showExcelSubtotal(sheet,nRows,'B','Total Factura');
              showExcelSubtotal(sheet,nRows,'D','Galones');
              showExcelSubtotal(sheet,nRows,'F','Total');                                     
            },
        'exportOptions':
        {
          columns:[0,1,2,3,4,5,6,8]
        },
        footer: true
      }], 

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Total over this page
            getSubtotal(api,2);
            getSubtotal(api,4);
            getSubtotal(api,6);
            getSubtotal(api,8);
      }
  });
});

  function convertDateFormat2(string) {
        var info = string.split('-').reverse().join('/');
        return info;
  }

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


$(document).ready(function() { 

  let $select_grifo       = $('#select_grifos');
  let $fecha_stock        = $('#fecha_stock');
  let $lectura_inicial    = $('#lectura_inicial');
  let $lectura_final      = $('#lectura_final');
  let $calibracion        = $('#calibracion');
  let $venta_dia_anterior = $('#venta_dia_anterior');
  let $venta_soles        = $('#venta_soles');
  let $precio_galon       = $('#precio_galon');
  let $stock_sistema      = $('#stock_sistema'); 
  let $stock_grifo       = $('#stock_grifo');
  let $traspaso           = $('#traspaso');
  let $diferencia         = $('#diferencia');
  let $recepcion          = $('#recepcion');
  let $cantidad_primax    = $('#cantidad_primax');
  let $cantidad_pecsa     = $('#cantidad_pecsa');  
  let $cantidad_pbf       = $('#cantidad_pbf');
  let $horario_pbf        = $('#horario_pbf');
  let $horario_pecsa      = $('#horario_pecsa');
  let $horario_primax     = $('#horario_primax');
  let $input_user         = $('#input_user');
  let $new_stock          = $('#new_stock');

  $fecha_stock.datepicker({
    //maxDate: 0,
  });  
  
  $fecha_stock.on('change', function (event) { 
    console.log();   
    let fecha_stock = $fecha_stock.val();
    fecha_stock = convertDateFormat(fecha_stock);
    fillSelectGrifos(fecha_stock); 
  });

  $select_grifo.on('change', function (event) {
    let id = $select_grifo.val();
      id = (id)?id:-1;   
    fillGrifo(id);       
  });


  $input_user.on('keyup', function (event) {
    let lectura_inicial = $lectura_inicial.val();
    let lectura_final =  $lectura_final.val();
    let calibracion = $calibracion.val();
    //en caso no ingrese nada, se asignará 0.00
    lectura_inicial   = (lectura_inicial)? parseFloat( lectura_inicial ): 0.00;
    lectura_final     = (lectura_final)? parseFloat( lectura_final ): 0.00;
    calibracion       = (calibracion)? parseFloat( calibracion ): 0.00;
    let total_galones = parseFloat(lectura_final-lectura_inicial-calibracion).toFixed(2);
    $venta_dia_anterior.val(total_galones);
    let precio_galon  = $precio_galon.val();
    precio_galon      = (precio_galon)?parseFloat(precio_galon):0.00;
    let monto_total   = parseFloat(total_galones * precio_galon).toFixed(2);
    $venta_soles.val(monto_total);

    
  /* --------------------- Obtener Diferencia  ----------------------*/
    let stock_sistema = $stock_sistema.val();
    let stock_grifo   = $stock_grifo.val();
    //stock_sistema   = (stock_sistema)? parseFloat( stock_sistema ): 0.00;
    stock_grifo    = (stock_grifo)? parseFloat( stock_grifo ): 0.00;  
    let diferencia = parseFloat(stock_grifo-stock_sistema).toFixed(2);
    $diferencia.val(diferencia);
    (diferencia<0)?   
    $diferencia.css('background-color', '#D17A69'):$diferencia.css('background-color', '#A3D58B');
    /* --------------------- Obtener nuevo stock sistema ----------------------*/
    let traspaso        = $traspaso.val();
    let recepcion       =  $recepcion.val();
    let cantidad_primax = $cantidad_primax.val();
    let cantidad_pecsa  = $cantidad_pecsa.val();
    let cantidad_pbf    = $cantidad_pbf.val();
                        //en caso no ingrese nada, se asignará 0.00
    cantidad_primax     = (cantidad_primax)? parseFloat( cantidad_primax ): 0.00;
    cantidad_pecsa      = (cantidad_pecsa)? parseFloat( cantidad_pecsa ): 0.00;
    cantidad_pbf        = (cantidad_pbf)? parseFloat( cantidad_pbf ): 0.00;

    let new_stock = parseFloat(Number(stock_sistema)-Number(traspaso)
                              +Number(recepcion)+Number(cantidad_primax)
                              +Number(cantidad_pecsa) + Number(cantidad_pbf)).toFixed(2);
    $new_stock.val(new_stock);

    if (monto_total<0.00) {
      activeDisabled('register');
    }else{
      desactiveDisabled('register'); 
    } 
    console.log(monto_total);
  });

  function evaluateSeries(){
    stock_sistema =$stock_sistema.val();
    if (stock_sistema=='') {//si no existe grifo
      $('#register').attr("disabled", true);
      activeReadOnly('lectura_inicial');
      activeReadOnly('lectura_final');
      activeReadOnly('calibracion');
      activeReadOnly('precio_galon');
      activeReadOnly('calibracion');
      activeReadOnly('stock_grifo');
      activeReadOnly('traspaso');
      activeReadOnly('recepcion');
      activeReadOnly('cantidad_primax');
      activeReadOnly('cantidad_pbf');
      activeReadOnly('cantidad_pecsa');
      activeDisabled('horario_primax');      
      activeDisabled('horario_pecsa');     
      activeDisabled('horario_pbf');
      $venta_dia_anterior.val('');
      $venta_soles.val('');     
    }else{     
      $('#register').attr("disabled", false);
      desactiveReadOnly('lectura_inicial');
      desactiveReadOnly('lectura_final');
      desactiveReadOnly('calibracion');
      desactiveReadOnly('precio_galon');
      desactiveReadOnly('stock_grifo');
      desactiveReadOnly('traspaso');
      desactiveReadOnly('recepcion');
      desactiveReadOnly('cantidad_primax');
      desactiveReadOnly('cantidad_pbf');
      desactiveReadOnly('cantidad_pecsa');
      desactiveReadOnly('cantidad_primax');
      desactiveDisabled('horario_primax');
      desactiveDisabled('horario_pecsa');
      desactiveDisabled('horario_pbf');
      inicializarSelect2plus($horario_primax,"Elija horario", '');
      inicializarSelect2plus($horario_pecsa,"Elija horario", '');
      inicializarSelect2plus($horario_pbf,"Elija horario", '');

      $venta_dia_anterior.val('');
      $venta_soles.val('');      
    }
  }

  function activeReadOnly(IdInput){
    $('#' + IdInput).val('');
    $('#' + IdInput).prop('readonly', true);
  }

  function activeDisabled(IdInput){
    $('#' + IdInput).val('');
    $('#' + IdInput).prop('disabled', true);
  }

  function desactiveDisabled(IdInput){
    $('#' + IdInput).val('');
    $('#' + IdInput).prop('disabled', false);
  }

  function desactiveReadOnly(IdInput) {
    $('#' + IdInput).val('');
    $('#' + IdInput).prop('readonly', false);
  }

  function fillGrifo(idGrifo){
    getGrifoById(idGrifo).done((data) => {     
    //$series.val(data.series_grifo);
    $stock_sistema.val(data.grifo.stock);
    evaluateSeries();
    console.log();

    }).fail((error) => {
      toastr.error('Ocurrio un error en el servidor!', 'Error Alert', { timeOut: 2000 });
    });
  }

  function convertDateFormat(string) {
        var info = string.split('/').reverse().join('-');
        return info;
  }

  function inicializarSelect2($select, text, data) {
    $select.select2({
      placeholder: text,
      data: data
    });
  }
  function fillSelectGrifos(fecha = '') {
    getAllGrifos(fecha)
      .done((data) => {
        $select_grifo.html('');
        inicializarSelect2($select_grifo, 'Seleccione el grifo', data.grifos);
        //llenado de series
        let id = $select_grifo.val();
        id = (id)?id:-1;   
        fillGrifo(id);
        //evaluateSeries();//evalua valor series         
      })
      .fail((error) => {
        toastr.error('Ocurrió un error', 'Error Alert', { timeOut: 2000 });
      });
  }


});

  function getAllGrifos(fecha) {
    return $.ajax({
      type: 'GET',
      url: `../stock_grifos/all/${fecha}`,
      dataType: 'json',
    });
  }

  function getGrifoById(idGrifo) {
    return $.ajax({
      type: 'GET',
      url: `../grifos/${idGrifo}`,
      dataType: 'json',
    });
  }
  function inicializarSelect2plus($select, text, data) {
  $select.prop('selectedIndex', -1);
  $select.select2({
    placeholder: text,
    allowClear: true,
    data: data
    });
  }
function validateDates() {
  let $tabla_pagos_lista = $('#tabla-factura-grifos');
  $('#fecha_inicio').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
  });
  $('#fecha_fin').datepicker({
    numberOfMonths: 1,
    onSelect: function (selected) {
      $('#fecha_inicio').datepicker('option', 'maxDate', selected)
    }
  });

  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $('#fecha_inicio').val();
      var sFin = $('#fecha_inicio').val();
      let cell = data[7];
      if (sInicio) {
        return sInicio === cell;
      }
      return true;
    }
  );

  $('#filtrar-fecha').on('click', function () {
    $tabla_pagos_lista.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $('#fecha_fin').val("");
    $tabla_pagos_lista.DataTable().draw();
    $('#filter-grifo').val('').trigger('change');
  });

  $('#today-fecha').on('click', function () {
    let hoy = $('#month_actual_date').val();
    console.log(hoy);
    $('#fecha_inicio').val(hoy);
    $('#fecha_fin').val(hoy);
    $tabla_pagos_lista.DataTable().draw();
  });
  $('#yesterday-fecha').on('click', function () {
    let ayer = $('#last_month_date').val();
    $('#fecha_inicio').val(ayer);
    $('#fecha_fin').val(ayer);
    $tabla_pagos_lista.DataTable().draw();
  });
}

$(document).ready(function() {
    validateDates();
    let $filter_proveedor = $('#filter-grifo');
    let $tabla_pedido_proveedores = $('#tabla-factura-grifos');
    inicializarSelect2plus($filter_proveedor, 'Ingrese el grifo', '');
      $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      let grifo = $filter_proveedor.find('option:selected').text();
      let cell = data[1];
      if (grifo) {
        return grifo === cell;
      }
      return true;
    }
  );

  $filter_proveedor.on('change', function () {
    $tabla_pedido_proveedores.DataTable().draw();
  });
} );

</script>
@endsection