$('#modal-edit-pedido_cliente').on('show.bs.modal',function(event){
  var id= $(event.relatedTarget).data('id');
  var nro_pedido= $(event.relatedTarget).data('nro_pedido');
  var scop= $(event.relatedTarget).data('scop');
  var galones= $(event.relatedTarget).data('galones');
  var precio_galon= $(event.relatedTarget).data('precio_galon');
  var grifo= $(event.relatedTarget).data('grifo');
  var planta= $(event.relatedTarget).data('planta');
  var horario_descarga= $(event.relatedTarget).data('horario_descarga'); 
  var observacion= $(event.relatedTarget).data('observacion'); 

  $(event.currentTarget).find('#nro_pedido-edit').val(nro_pedido);
  $(event.currentTarget).find('#scop-edit').val(scop);
  $(event.currentTarget).find('#galones-edit').val(galones);
  $(event.currentTarget).find('#precio_galon-edit').val(precio_galon);
  $(event.currentTarget).find('#grifo-edit').val(grifo);
  $(event.currentTarget).find('#planta-edit').val(planta);
  $(event.currentTarget).find('#horario_descarga-edit').val(horario_descarga);
  $(event.currentTarget).find('#observacion-edit').val(observacion);
  $(event.currentTarget).find('#id-edit').val(id);
});

$('#modal-confirmar-pedido').on('show.bs.modal',function(event){
  var id= $(event.relatedTarget).data('id');
  var nro_pedido= $(event.relatedTarget).data('nro_pedido');
  var fecha_pedido= $(event.relatedTarget).data('fecha_pedido');
  var horario_descarga= $(event.relatedTarget).data('horario_descarga'); 
  var observacion= $(event.relatedTarget).data('observacion'); 

  $(event.currentTarget).find('#nro_pedido-confirmar').val(nro_pedido);
  $(event.currentTarget).find('#fecha_pedido-confirmar').val(fecha_pedido);
  $(event.currentTarget).find('#horario_descarga-confirmar').val(horario_descarga);
  $(event.currentTarget).find('#observacion-confirmar').val(observacion);
  $(event.currentTarget).find('#id-confirmar').val(id);
});

$('#modal-show-pedido_cliente').on('show.bs.modal',function(event){
  var nro_pedido= $(event.relatedTarget).data('nro_pedido');
  var scop= $(event.relatedTarget).data('scop');
  var fecha_pedido= $(event.relatedTarget).data('fecha_pedido');
  var galones= $(event.relatedTarget).data('galones');
  var grifo= $(event.relatedTarget).data('grifo');
  var planta= $(event.relatedTarget).data('planta');
  var precio_galon= $(event.relatedTarget).data('precio_galon'); 
  var precio_total= $(event.relatedTarget).data('precio_total'); 
  var horario_descarga= $(event.relatedTarget).data('horario_descarga'); 
  var observacion= $(event.relatedTarget).data('observacion'); 
 

  $(event.currentTarget).find('#nro_pedido-show').val(nro_pedido);
  $(event.currentTarget).find('#scop-show').val(scop);
  $(event.currentTarget).find('#fecha_pedido-show').val(fecha_pedido);
  $(event.currentTarget).find('#grifo-show').val(grifo);
  $(event.currentTarget).find('#galones-show').val(galones);
  $(event.currentTarget).find('#planta-show').val(planta);
  $(event.currentTarget).find('#precio_galon-show').val(precio_galon);
  $(event.currentTarget).find('#precio_total-show').val(precio_total);
  $(event.currentTarget).find('#horario_descarga-show').val(horario_descarga);
  $(event.currentTarget).find('#observacion-show').val(observacion);
});

$('#modal-create-pago').on('show.bs.modal',function(event){
  var id= $(event.relatedTarget).data('id');
  var nro_pedido= $(event.relatedTarget).data('nro_pedido');
  var fecha_pedido=$.datepicker.parseDate('d/m/yy',$(event.relatedTarget).data('fecha_pedido'));
  $(event.currentTarget).find('#nro_pedido-pago').val(nro_pedido);
  $(event.currentTarget).find('#pedido_cliente_id-pago').val(id);
  $("#fecha_operacion").datepicker({
    minDate:fecha_pedido,
  });
});

/**Activar/Desactivar Inputs del formulario */
$(document).ready(function() { 
  $("#datos-pedido :input").prop("disabled", true);
  $('#datos-producto :input').prop("disabled",true);
  $("#cliente").prop("selectedIndex", -1);
  $("#cliente").select2({
    placeholder: "Ingresa la razon social",
    allowClear:true
  });
  $("#cliente").on('change',function(){
    var id=$("#cliente").val();
    var deshabilitar=true;
    if(id){
      findByRazonSocial(id);
      deshabilitar=false;
    }else{
      $('#ruc').val('');
    }
    $("#datos-pedido :input").prop("disabled", deshabilitar);
    $('#datos-producto :input').prop("disabled",deshabilitar);
  });

});

/**Inicializar DataTable */
$(document).ready(function() {
  $('#tabla-pedido_clientes').DataTable({
    'language': {
        'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
      }
  });
  $('#filtrar').on('click',function(){
    $('#tabla-pedido_clientes').DataTable().draw();
  });
});

/* Agregar filtro datatable */
$.fn.dataTable.ext.search.push(
  function( settings, data, dataIndex ) {
      var sInicio=$('#fecha_inicio').val();
      var sFin=$('#fecha_fin').val();
      var inicio = $.datepicker.parseDate('d/m/yy', sInicio) ;
      var fin = $.datepicker.parseDate('d/m/yy', sFin)  ;
      var dia = $.datepicker.parseDate('d/m/yy',data[1]) ;
      
      if (!inicio || !dia || fin>=dia && inicio<=dia ){
        return true;
      }
      return false;
  }
);

/** Inicializar datos  */
$(document).ready(function() { 
  fechaActual();
  calcularTotal();
  validateDates();
});

function calcularTotal(){
  $("#producto").on('keyup',function(){
    var total=0;
    var galones=$('#galones').val();
    var precio=$('#precio_galon').val();
    total=galones*precio;
    $('#saldo').val(total);
  });
}

function fechaActual(){
  $("#fecha_pedido").val($.datepicker.formatDate('d/m/yy', new Date()));
}

function validateDates(){
  $("#fecha_inicio").datepicker({
    numberOfMonths: 2,
    onSelect: function(selected) {
      $("#fecha_fin").datepicker("option","minDate", selected)
    }
  });
  $("#fecha_fin").datepicker({ 
    numberOfMonths: 2,
    onSelect: function(selected) {
      $("#fecha_inicio").datepicker("option","maxDate", selected)
    }
  });  
  $("#fecha_descarga").datepicker({ 
    minDate: 0,
  });
}

/* AJAX Buscar por Razon Social */
function findByRazonSocial(id){
  $.ajax({
    type: 'GET',
    url:`../clientes/${id}`,
    success: (data)=>{
      $('#ruc').val(data.ruc);
    }
  });
}

$('#treeview-ventas').on('click',function(event){
  $('#treeview-proveedores').removeClass("active");
  $('#treeview-clientes').removeClass("active");
  $('#treeview-ventas').addClass("active");
})