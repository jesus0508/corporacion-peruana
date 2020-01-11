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
  @include( 'factura_grifos.header' )
  @include('factura_grifos.create') 
  @include('factura_grifos.table')
 <!--  modal -->
 @include('factura_grifos.modal_edit')
 <!--  end modal -->
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>

$(document).ready(function() {

    let $input_user_edit = $('#input_user-edit');
    let $venta_factura_edit = $('#venta_factura-edit');
    let $venta_boleta_edit = $('#venta_boleta-edit');
    let $total_galones_edit=$('#total_galones-edit');
    let $monto_total_edit=$('#monto_total-edit');
    let $precio_galon_edit =$('#precio_venta-edit');

    $input_user_edit.on('keyup', function (event) {

    let venta_factura_edit = $venta_factura_edit.val();
    let venta_boleta_edit =  $venta_boleta_edit.val();
    //console.log(venta_factura_edit);
    //en caso no ingrese nada, se asignará 0.00
    venta_factura_edit  = (venta_factura_edit)? parseFloat( venta_factura_edit ): 0.00;
    venta_boleta_edit   = (venta_boleta_edit)? parseFloat( venta_boleta_edit ): 0.00;
    let total_galones_edit = parseFloat(venta_factura_edit+venta_boleta_edit).toFixed(2);
    $total_galones_edit.val(total_galones_edit);
    let precio_galon_edit = $precio_galon_edit.val();
    precio_galon_edit = (precio_galon_edit)?parseFloat(precio_galon_edit):0.00;
    let monto_total_edit = parseFloat(total_galones_edit * precio_galon_edit).toFixed(2);
    $monto_total_edit.val(monto_total_edit);
    if (monto_total_edit<=0.00) {
      $('#register-edit').attr("disabled", true);
    }else{
      $('#register-edit').attr("disabled", false);
    }   

  });

  $('#modal-edit-facturacion').on('show.bs.modal',function(event){
    var id= $(event.relatedTarget).data('id');
    $.ajax({
      type: 'GET',
      url:`./${id}/edit`,
      dataType : 'json',
      success: (data)=>{        
        let fecha_facturacion = convertDateFormat2(data.facturacion.fecha_facturacion);
        let venta_factura = data.facturacion.venta_factura;
        let venta_boleta =  data.facturacion.venta_boleta;
        let precio_galon = data.facturacion.precio_venta;

        $(event.currentTarget).find('#grifo_id-edit').val(data.facturacion.grifo.id); 
        $(event.currentTarget).find('#grifo_name-edit').val(data.facturacion.grifo.razon_social); 
        $(event.currentTarget).find('#venta_boleta-edit').val(venta_boleta); 
        $(event.currentTarget).find('#venta_factura-edit').val(venta_factura);   
        $(event.currentTarget).find('#fecha_facturacion-edit').val(fecha_facturacion);
        $(event.currentTarget).find('#numero_factura-edit').val(data.facturacion.numero_factura);
        $(event.currentTarget).find('#precio_venta-edit').val(precio_galon);
        $(event.currentTarget).find('#nro_serie-edit').val(data.facturacion.series);
        //en caso no ingrese nada, se asignará 0.00
        venta_factura  = (venta_factura)? parseFloat( venta_factura ): 0.00;
        venta_boleta   = (venta_boleta)? parseFloat( venta_boleta ): 0.00;    
        precio_galon = (precio_galon)?parseFloat(precio_galon):0.00;
        let total_galones = parseFloat(venta_factura+venta_boleta).toFixed(2);
        let monto_total = parseFloat(total_galones * precio_galon).toFixed(2);
        $(event.currentTarget).find('#total_galones-edit').val(total_galones);
        $(event.currentTarget).find('#monto_total-edit').val(monto_total);
        $(event.currentTarget).find('#id-edit').val(data.facturacion.id);
      },
      error: (error)=>{
        toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
      }
    });
  });


  $('#tabla-factura-grifos').DataTable({
      "columnDefs": [{
                "targets": [ 7 ],
                "visible": false
            },
            { orderable: false, targets: -1},
            { searchable: false, targets: [-1]},

            ],
      "responsive": true,
      "searching":true,
      "dom": 'Blfrtip',
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
    //console.log("cambio fecha ingreso");   
    let fecha_ingreso = $fecha_ingreso.val();
    fecha_ingreso = convertDateFormat(fecha_ingreso);
    fillSelectGrifos(fecha_ingreso); 
  });

  $select_grifo.on('change', function (event) {
    let id = $select_grifo.val();
    let fecha_ingreso = $fecha_ingreso.val();
    fecha_ingreso = convertDateFormat(fecha_ingreso);
    id = (id)?id:-1;  
    fillSeries(id,fecha_ingreso);       
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
    if (monto_total<=0.00) {
      $('#register').attr("disabled", true);
    }else{
      $('#register').attr("disabled", false);
    }   

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
     // desactiveReadOnly('precio_galon');
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

  function fillSeries(idGrifo,fecha){
    getIngresoByGrifo(idGrifo,fecha).done((data) => {     
        //lenar selectr
    $series.html('');
    inicializarSelect2($series, 'Seleccione la serie', data.series);
    $precio_galon.val(data.precio_galon);
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
        let fecha_ingreso = $fecha_ingreso.val();
        fecha_ingreso = convertDateFormat(fecha_ingreso);
        id = (id)?id:-1;  
        fillSeries(id,fecha_ingreso);
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

//Obtener series sin facturar
  function getIngresoByGrifo(idGrifo, fecha) {
    return $.ajax({
      type: 'GET',
      url: `../series_grifo/${idGrifo}/${fecha}`,
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