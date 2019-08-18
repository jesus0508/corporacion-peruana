$('#modal-edit-grifo').on('show.bs.modal', function (event) {     
  var id= $(event.relatedTarget).data('id');
  $.ajax({
    type: 'GET',
    url:`./grifos/${id}`,
    dataType : 'json',
    data: {
      id : $(`#id`).val(),
    },
    success: (data)=>{
      $(event.currentTarget).find('#ruc-edit').val(data.grifo.ruc);
      $(event.currentTarget).find('#razon_social-edit').val(data.grifo.razon_social);
      $(event.currentTarget).find('#telefono-edit').val(data.grifo.telefono);
      $(event.currentTarget).find('#administrador-edit').val(data.grifo.administrador);
      $(event.currentTarget).find('#stock-edit').val(data.grifo.stock);
      $(event.currentTarget).find('#distrito-edit').val(data.grifo.distrito);
      $(event.currentTarget).find('#direccion-edit').val(data.grifo.direccion);
      $(event.currentTarget).find('#id-edit').val(data.grifo.id);
    },
    error: (error)=>{
      toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
    }
  });
});


$('#modal-show-grifo').on('show.bs.modal', function (event) {    
  var id= $(event.relatedTarget).data('id');
  $.ajax({
    type: 'GET',
    url:`./grifos/${id}/edit`,
    dataType : 'json',
    data: {
      'id' : $(`#id`).val(),
    },
    success: (data)=>{
      $(event.currentTarget).find('#ruc-show').val(data.grifo.ruc);
      $(event.currentTarget).find('#razon_social-show').val(data.grifo.razon_social);
      $(event.currentTarget).find('#telefono-show').val(data.grifo.telefono);
      $(event.currentTarget).find('#administrador-show').val(data.grifo.administrador);
      $(event.currentTarget).find('#stock-show').val(data.grifo.stock);
      $(event.currentTarget).find('#distrito-show').val(data.grifo.distrito);
      $(event.currentTarget).find('#direccion-show').val(data.grifo.direccion);
    },
    error: (error)=>{
      toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
    }
  });
});

$(document).ready(function() {
  $('#tabla-grifos').DataTable({
    language: {
       url : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
    }, 
    columnDefs: [ 
    { 
      orderable: false, 
      targets: [ -1 ] 
    },
    { 
      searchable: false, 
      targets: [-1] 
    },
    ] 
  });
  } 
);