$('#modal-edit-vehiculo').on('show.bs.modal',function(event){
  var id = $(event.relatedTarget).data('id');
  var placa = $(event.relatedTarget).data('placa');
  var modelo = $(event.relatedTarget).data('modelo');
  var marca = $(event.relatedTarget).data('marca');
  var transportista_id = $(event.relatedTarget).data('transportista_id');

  $(event.currentTarget).find('#placa-edit').val(placa);
  $(event.currentTarget).find('#modelo-edit').val(modelo);
  $(event.currentTarget).find('#marca-edit').val(marca);
  $(event.currentTarget).find('#id-edit').val(id);
  $(event.currentTarget).find('#transportista_id-edit').val(transportista_id);
 

});

$(document).ready(function() {
 

  $('#tabla-vehiculos').DataTable({
    'language': {
             'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        },
              "order": [[ 0, "desc" ]]
  });
} );



