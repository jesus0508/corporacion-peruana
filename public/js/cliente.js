$('#modal-edit-cliente').on('show.bs.modal', function (event) {          
  var id = $(event.relatedTarget).data().id;
  var ruc = $(event.relatedTarget).data().ruc;
  var razon_social = $(event.relatedTarget).data().razonsocial;
  var tipo = $(event.relatedTarget).data().tipo;
  var direccion = $(event.relatedTarget).data().direccion;
  $(event.currentTarget).find('#ruc-edit').val(ruc);
  $(event.currentTarget).find('#razon_social-edit').val(razon_social);
  $(event.currentTarget).find('#tipo-edit').val(tipo);
  $(event.currentTarget).find('#direccion-edit').val(direccion);
  $(event.currentTarget).find('#id-edit').val(id);
})

$('#modal-show-cliente').on('show.bs.modal', function (event) {    
  var id = $(event.relatedTarget).data().id;
  var ruc = $(event.relatedTarget).data().ruc;
  var razon_social = $(event.relatedTarget).data().razonsocial;
  var tipo = $(event.relatedTarget).data().tipo;
  var direccion = $(event.relatedTarget).data().direccion;
  $(event.currentTarget).find('#ruc-show').val(ruc);
  $(event.currentTarget).find('#razon_social-show').val(razon_social);
  $(event.currentTarget).find('#tipo-show').val(tipo);
  $(event.currentTarget).find('#direccion-show').val(direccion);
})

$(document).ready(function() {
  $('#tabla-clientes').DataTable({
    'language': {
             'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        }
  });
} );