@extends('layouts.main')

@section('title','Venta Facturada')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">

@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Grifos</a></li>
  <li><a href="#">Cancelaciones</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  @include( 'factura_grifos.header' )
  @include('factura_grifos.create') 
  @include('factura_grifos.table')
  
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script>

$(document).ready(function() {
  $('#tabla-factura-grifos').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "columnDefs": [{
                "targets": [ 7 ],
                "visible": false
            }],
      "responsive": true,
      "searching":true,
      "dom": 'Bfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Lista Facturación Grifo',
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
              
              let nRows = clR.length;//6
              let total = $('c[r=F'+nRows+'] t', sheet).text();                
              $('row:last c t', sheet).text( '' );
              $('c[r=F'+nRows+'] t', sheet).text('TOTAL:' );
              $('c[r=F'+nRows+'] t', sheet).attr('s','37');
              $('c[r=G'+nRows+'] t', sheet).text( total );
              $('c[r=G'+nRows+'] t', sheet).attr('s','37');             
            },
        'exportOptions':
        {
          columns:[0,1,2,3,4,5,6]
        },
        footer: true
      }], 

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Total over this page
            pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2); 
            // Update footer
            $( api.column( 6 ).footer() ).html(
                pageTotal
                // +' (S/.'+ total +' total)'
            );
      }
  });
});

$(document).ready(function() { 

  let $select_grifo  = $('#select_grifos');
  let $fecha_ingreso = $('#fecha');
  let $series        = $('#nro_serie');
  let $venta_factura = $('#venta_factura');
  let $venta_boleta  = $('#venta_boleta');
  let $total_galones = $('#total_galones');
  let $precio_galon  = $('#precio_galon');
  let $monto_total   = $('#monto_total');
  let $input_user    = $('#input_user');//row 
  let $facturacion   = $('#facturacion');
  let $input_user_top= $('#input_user_top');

  $fecha_ingreso.datepicker({
    //maxDate: 0,
  });  

  $fecha_ingreso.on('change', function (event) { 
    console.log();   
    let fecha_ingreso = $fecha_ingreso.val();
    fecha_ingreso = convertDateFormat(fecha_ingreso);
    fillSelectGrifos(fecha_ingreso); 
  });

  $select_grifo.on('change', function (event) {
    let id = $select_grifo.val();
      id = (id)?id:-1;   
    fillSeries(id);       
  });


  $input_user.on('keyup', function (event) {
    let venta_factura = $venta_factura.val();
    let venta_boleta =  $venta_boleta.val();
    //en caso no ingrese nada, se asignará 0.00
    venta_factura  = (venta_factura)? parseFloat( venta_factura ): 0.00;
    venta_boleta   = (venta_boleta)? parseFloat( venta_boleta ): 0.00;
    let total_galones = parseFloat(venta_factura+venta_boleta).toFixed(2);
    $total_galones.val(total_galones);
    let precio_galon = $precio_galon.val();
    precio_galon = (precio_galon)?parseFloat(precio_galon):0.00;
    let monto_total = parseFloat(total_galones * precio_galon).toFixed(2);
    $monto_total.val(monto_total);   
  });

  function evaluateSeries(){
    series =$series.val();
    if (series=='') {
      $('#register').attr("disabled", true);
      activeReadOnly('facturacion');
      activeReadOnly('venta_factura');
      activeReadOnly('venta_boleta');
      activeReadOnly('precio_galon');
      $total_galones.val('');
      $monto_total.val('');     
    }else{     
      $('#register').attr("disabled", false);
      desactiveReadOnly('facturacion');
      desactiveReadOnly('venta_factura');
      desactiveReadOnly('venta_boleta');
      desactiveReadOnly('precio_galon');
      $total_galones.val('');
      $monto_total.val(''); 
    }
  }

  function activeReadOnly(IdInput){
    $('#' + IdInput).val('');
    $('#' + IdInput).prop('readonly', true);
  }

  function desactiveReadOnly(IdInput) {
    $('#' + IdInput).val('');
    $('#' + IdInput).prop('readonly', false);
  }

  function fillSeries(idGrifo){
    getIngresoByGrifo(idGrifo).done((data) => {     
    $series.val(data.series_grifo);
    evaluateSeries();
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
        fillSeries(id);
        evaluateSeries();//evalua valor series         
      })
      .fail((error) => {
        toastr.error('Ocurrió un error', 'Error Alert', { timeOut: 2000 });
      });
  }


});

  function getAllGrifos(fecha) {
    return $.ajax({
      type: 'GET',
      url: `../grifos_facturacion/all/${fecha}`,
      dataType: 'json',
    });
  }

  function getIngresoByGrifo(idGrifo) {
    return $.ajax({
      type: 'GET',
      url: `../series_grifo/${idGrifo}`,
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