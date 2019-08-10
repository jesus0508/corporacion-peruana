$(document).ready(function() {
  $('#tabla-trabajadores').DataTable({
    language: {
      url : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
    }
  });
  $("#fecha_nacimiento").datepicker({ 
    maxDate: 0,
  });
});

$('#modal-edit-trabajador').on('show.bs.modal', function (event) {          
  var id = $(event.relatedTarget).data().id;
  var dni= $(event.relatedTarget).data().dni;
  var nombres = $(event.relatedTarget).data().nombres;
  var apellido_paterno = $(event.relatedTarget).data('apellido_paterno');
  var apellido_materno = $(event.relatedTarget).data('apellido_materno');
  var fecha_nacimiento = $(event.relatedTarget).data().fecha_nacimiento;
  var telefono = $(event.relatedTarget).data().telefono;
  var email = $(event.relatedTarget).data().email;
  var genero=$(event.relatedTarget).data().genero;
  var direccion = $(event.relatedTarget).data().direccion;

  $(event.currentTarget).find('#dni-edit').val(dni);
  $(event.currentTarget).find('#nombres-edit').val(nombres);
  $(event.currentTarget).find('#apellido_paterno-edit').val(apellido_paterno);
  $(event.currentTarget).find('#apellido_materno-edit').val(apellido_materno);
  $(event.currentTarget).find('#fecha_nacimiento-edit').val(fecha_nacimiento);
  $(event.currentTarget).find('#telefono-edit').val(telefono);
  $(event.currentTarget).find('#email-edit').val(email);
  var radio=`#genero-edit-${genero}`;
  $(radio).attr('checked', true); 
  $(event.currentTarget).find('#direccion-edit').val(direccion);

  $(event.currentTarget).find('#id-edit').val(id);
  $("#fecha_nacimiento-edit").datepicker({ 
    maxDate: 0,
  });
});

$('#modal-show-trabajador').on('show.bs.modal', function (event) {    
  var dni= $(event.relatedTarget).data().dni;
  var nombres = $(event.relatedTarget).data().nombres;
  var apellido_paterno = $(event.relatedTarget).data().apellido_paterno;
  var apellido_materno = $(event.relatedTarget).data().apellido_materno;
  var telefono = $(event.relatedTarget).data().telefono;
  var email = $(event.relatedTarget).data().email;
  var fecha_nacimiento = $(event.relatedTarget).data().fecha_nacimiento;
  var genero=$(event.relatedTarget).data().genero;
  var direccion = $(event.relatedTarget).data().direccion;

  $(event.currentTarget).find('#dni-show').val(dni);
  $(event.currentTarget).find('#nombres-show').val(nombres);
  $(event.currentTarget).find('#apellido_paterno-show').val(apellido_paterno);
  $(event.currentTarget).find('#apellido_materno-show').val(apellido_materno);
  $(event.currentTarget).find('#fecha_nacimiento-show').val(fecha_nacimiento);
  $(event.currentTarget).find('#email-show').val(email);
  $(event.currentTarget).find('#telefono-show').val(telefono);
  $(event.currentTarget).find('#genero-show').val(genero);
  $(event.currentTarget).find('#direccion-show').val(direccion);
});

$('#modal-create-user').on('show.bs.modal', function (event) {    
  var trabajador_id = $(event.relatedTarget).data().trabajador_id;
  $(event.currentTarget).find('#trabajador_id').val(trabajador_id);
});

