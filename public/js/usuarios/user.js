$(document).ready(function () {
  $('#tabla-trabajadores').DataTable({
    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
    }
  });
  $("#fecha_nacimiento").datepicker({
    maxDate: 0,
  });
});

$('#modal-edit-trabajador').on('show.bs.modal', function (event) {
  var id = $(event.relatedTarget).data().id;
  $.ajax({
    type: 'GET',
    url: `./trabajadores/${id}/edit`,
    dataType: 'json',
    data: {
      id: $(`#id`).val(),
    },
    success: function (data) {
      $(event.currentTarget).find('#dni-edit').val(data.trabajador.dni);
      $(event.currentTarget).find('#nombres-edit').val(data.trabajador.nombres);
      $(event.currentTarget).find('#apellido_paterno-edit').val(data.trabajador.apellido_paterno);
      $(event.currentTarget).find('#apellido_materno-edit').val(data.trabajador.apellido_materno);
      $(event.currentTarget).find('#fecha_nacimiento-edit').val(data.trabajador.fecha_nacimiento);
      $(event.currentTarget).find('#telefono-edit').val(data.trabajador.telefono);
      $(event.currentTarget).find('#email-edit').val(data.trabajador.email);
      var radio = `#genero-edit-${data.trabajador.genero}`;
      $(radio).attr('checked', true);
      $(event.currentTarget).find('#direccion-edit').val(data.trabajador.direccion);
      $(event.currentTarget).find('#id-edit').val(data.trabajador.id);
    },
    error: function (error) {

    }
  });
  $("#fecha_nacimiento-edit").datepicker({
    maxDate: 0,
  });
});

$('#modal-show-trabajador').on('show.bs.modal', function (event) {
  var id = $(event.relatedTarget).data().id;
  $.ajax({
    type: 'GET',
    url: `./trabajadores/${id}`,
    dataType: 'json',
    data: {
      id: $(`#id`).val(),
    },
    success: function (data) {
      $(event.currentTarget).find('#dni-show').val(data.trabajador.dni);
      $(event.currentTarget).find('#nombres-show').val(data.trabajador.nombres);
      $(event.currentTarget).find('#apellido_paterno-show').val(data.trabajador.apellido_paterno);
      $(event.currentTarget).find('#apellido_materno-show').val(data.trabajador.apellido_materno);
      $(event.currentTarget).find('#fecha_nacimiento-show').val(data.trabajador.fecha_nacimiento);
      $(event.currentTarget).find('#email-show').val(data.trabajador.email);
      $(event.currentTarget).find('#telefono-show').val(data.trabajador.telefono);
      $(event.currentTarget).find('#genero-show').val(data.trabajador.genero);
      $(event.currentTarget).find('#direccion-show').val(data.trabajador.direccion);
    },
    error: function (error) {

    }


  });
});

$('#modal-create-user').on('show.bs.modal', function (event) {
  var trabajador_id = $(event.relatedTarget).data().trabajador_id;
  $(event.currentTarget).find('#trabajador_id').val(trabajador_id);
});

