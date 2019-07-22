$('#modal-edit-pedido-cliente').on('show.bs.modal',function(event){
  var id= $(event.relatedTarget).data('id');
  var nro_pedido= $(event.relatedTarget).data('nro_pedido');
  var scop= $(event.relatedTarget).data('scop');
  var grifo= $(event.relatedTarget).data('grifo');
  var planta= $(event.relatedTarget).data('planta');
  var horario_descarga= $(event.relatedTarget).data('horario_descarga'); 
  var observacion= $(event.relatedTarget).data('observacion'); 

  $(event.currentTarget).find('#nro_pedido-edit').val(nro_pedido);
  $(event.currentTarget).find('#scop-edit').val(scop);
  $(event.currentTarget).find('#grifo-edit').val(grifo);
  $(event.currentTarget).find('#planta-edit').val(planta);
  $(event.currentTarget).find('#horario_descarga-edit').val(horario_descarga);
  $(event.currentTarget).find('#observacion-edit').val(observacion);
  $(event.currentTarget).find('#id-edit').val(id);
});

$('#modal-show-pedido-cliente').on('show.bs.modal',function(event){
  var nro_pedido= $(event.relatedTarget).data('nro_pedido');
  var scop= $(event.relatedTarget).data('scop');
  var grifo= $(event.relatedTarget).data('grifo');
  var planta= $(event.relatedTarget).data('planta');
  var horario_descarga= $(event.relatedTarget).data('horario_descarga'); 
  var observacion= $(event.relatedTarget).data('observacion'); 

  $(event.currentTarget).find('#nro_pedido-show').val(nro_pedido);
  $(event.currentTarget).find('#scop-show').val(scop);
  $(event.currentTarget).find('#grifo-show').val(grifo);
  $(event.currentTarget).find('#planta-show').val(planta);
  $(event.currentTarget).find('#horario_descarga-show').val(horario_descarga);
  $(event.currentTarget).find('#observacion-show').val(observacion);
});

$(document).ready(function() {
  $('#tabla-pedido_clientes').DataTable({
    'language': {
        'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
      }
  });
} );