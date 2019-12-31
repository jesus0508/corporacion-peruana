@extends('layouts.main')
@section('title','Egresos Grifos')
@section('styles')
{{-- select2 4.0.8 --}}
<link rel="stylesheet" href="{{asset('dist/css/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Egresos Grifos</a></li>
  <li><a href="#">Listado</a></li>
</ol>
@endsection

@section('content')
<section class="content">

  	@include('gastos.listado.buttons_top')
  	@include('gastos.listado.table')

	<!-- modales -->
    @include('gastos.listado.modal_edit')
   <!-- fin modales -->
</section>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/select2/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
  $('#tabla-gastos-listado').DataTable({   
      "responsive": true,
      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
             pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
 
            // Update footer
            $( api.column( 6 ).footer() ).html(
                'S/. '+pageTotal
                // +' (S/.'+ total +' total)'
            );
      }
  });

  $('#fecha_egreso-edit').datepicker();
  $select_grifos = $('#grifo_id');
  $('#modal-edit-egreso-grifo').on('show.bs.modal',function(event){
    var id= $(event.relatedTarget).data('id');
    $.ajax({
      type: 'GET',
      url:`./egresos/${id}/edit`,
      dataType : 'json',
      success: (data)=>{        
        let grifo_id = data.egreso.grifo_id;
        let fecha_egreso = convertDateFormat2(data.egreso.fecha_egreso);
        console.log(data.egreso.concepto_gasto_id);
        $(event.currentTarget).find('#categoria-edit').val(data.egreso.categoria);
        $(event.currentTarget).find('#concepto-edit').val(data.egreso.concepto);
        $(event.currentTarget).find('#monto_egreso-edit').val(data.egreso.monto_egreso);
        $(event.currentTarget).find('#subcategoria-edit').val(data.egreso.subcategoria);        
        $(event.currentTarget).find('#fecha_egreso-edit').val(fecha_egreso);
        $(event.currentTarget).find('#codigo-edit').val(data.egreso.codigo);
        $(event.currentTarget).find('#id-edit').val(data.egreso.id);
        $(event.currentTarget).find('#concepto_gasto_id-edit').val(data.egreso.concepto_gasto_id);
        
        let lista_grifos = '';
        data.grifos.forEach((grifo) => {
          lista_grifos += `<option value="${grifo.id}">${grifo.razon_social}</option>`;
        });
        $select_grifos.html(lista_grifos);
        inicializarSelect2($select_grifos, 'Seleccione el grifo');
        $select_grifos.val(grifo_id).trigger('change');
      },
      error: (error)=>{
        toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
      }
    });
  });
});


function convertDateFormat2(string) {
        var info = string.split('-').reverse().join('/');
        return info;
  }

function inicializarSelect2($select, text) {
  $select.prop('selectedIndex', -1);
  $select.select2({
    placeholder: text,
    allowClear: true,
  });
}

function validateDates() {
	//console.log('entro a validate');
  let $tabla_pagos_lista = $('#tabla-gastos-listado');
 
  $('#fecha_inicio').datepicker({
    numberOfMonths: 1,
    onSelect: function (selected) {
      $('#fecha_fin').datepicker('option', 'minDate', selected)
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
      var inicio = $.datepicker.parseDate('d/m/yy', sInicio);
      var fin = $.datepicker.parseDate('d/m/yy', sFin);
      var dia = $.datepicker.parseDate('d/m/yy', data[0]);
      if (!inicio || !dia || fin >= dia && inicio <= dia) {
        return true;
      }
      return false;
    });

    $('#filtrar-fecha').on('click', function () {
      $tabla_pagos_lista.DataTable().draw();
    });

    $('#clear-fecha').on('click', function () {
        $('#fecha_inicio').val("");
        $('#fecha_fin').val("");
        $tabla_pagos_lista.DataTable().draw();
    });
  }
  
  $(document).ready(function() {
    validateDates();
  });
</script>
@endsection