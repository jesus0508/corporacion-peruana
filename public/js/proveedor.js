$('#modal-edit-proveedor').on('show.bs.modal', function (event) {          
  var id = $(event.relatedTarget).data().id;
  var razon_social = $(event.relatedTarget).data().razon_social;
  var direccion = $(event.relatedTarget).data().direccion;
  var representante = $(event.relatedTarget).data().representante;
  var celular = $(event.relatedTarget).data().celular;
  
  $(event.currentTarget).find('#razon_social-edit').val(razon_social);
  $(event.currentTarget).find('#direccion-edit').val(direccion);
  $(event.currentTarget).find('#representante-edit').val(representante);
  $(event.currentTarget).find('#celular-edit').val(celular);

})

