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

$(document).ready(function() {
  $('#tabla-pedido_clientes').DataTable({
    'language': {
        'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
      }
  });
});