$('#treeview-transportistas').on('click',function(event){
  $('#treeview-clientes').removeClass("active");
  $('#treeview-pagos').removeClass("active");
  $('#treeview-ventas').removeClass("active");
  $('#treeview-reportes').removeClass("active");
  $('#treeview-transportistas').addClass("active");
})

  $('#modal-edit-transportista').on('show.bs.modal',function(event){
  var id = $(event.relatedTarget).data('id');
  var nombre_transportista = $(event.relatedTarget).data('nombre_transportista');
  var brevete = $(event.relatedTarget).data('brevete');
  var celular_transportista = $(event.relatedTarget).data('celular_transportista');

  $(event.currentTarget).find('#nombre_transportista-edit').val(nombre_transportista);
  $(event.currentTarget).find('#brevete-edit').val(brevete);
  $(event.currentTarget).find('#celular_transportista-edit').val(celular_transportista);
  $(event.currentTarget).find('#id-edit').val(id);
});

$('#modal-edit-vehiculo').on('show.bs.modal',function(event){
  var id = $(event.relatedTarget).data('id');
  var placa = $(event.relatedTarget).data('placa');
  var modelo = $(event.relatedTarget).data('modelo');
  var marca = $(event.relatedTarget).data('marca');
  var marca = $(event.relatedTarget).data('proveedor_id');

  $(event.currentTarget).find('#placa-edit').val(placa);
  $(event.currentTarget).find('#modelo-edit').val(modelo);
  $(event.currentTarget).find('#marca-edit').val(marca);
  $(event.currentTarget).find('#id-edit').val(id);
  $(event.currentTarget).find('#proveedor_id-edit').val(proveedor_id);
 

});

$(document).ready(function() {
  //$("#transportista").prop("selectedIndex", -1);
  
  $("#transportista").select2();
  } );

$(document).ready(function() {
 

  $('#tabla-transportistas').DataTable({
    'language': {
             'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        },
              "order": [[ 0, "desc" ]]
  });
} );