$('#modal-edit-cliente').on('show.bs.modal', function (event) {     
  var id= $(event.relatedTarget).data('id');
  $.ajax({
    type: 'GET',
    url:`./clientes/${id}`,
    dataType : 'json',
    data: {
      id : $(`#id`).val(),
    },
    success: (data)=>{
      $(event.currentTarget).find('#ruc-edit').val(data.cliente.ruc);
      $(event.currentTarget).find('#razon_social-edit').val(data.cliente.razon_social);
      $(event.currentTarget).find('#telefono-edit').val(data.cliente.telefono);
      $(event.currentTarget).find('#tipo-edit').val(data.cliente.tipo);
      $(event.currentTarget).find('#direccion-edit').val(data.cliente.direccion);
      $(event.currentTarget).find('#linea_credito-edit').val(data.cliente.linea_credito);
      //$(event.currentTarget).find('#periocidad-edit').val(data.cliente.periocidad);
      $(event.currentTarget).find('#id-edit').val(data.cliente.id);
    },
    error: (error)=>{
      toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
    }
  });
});


$('#modal-show-cliente').on('show.bs.modal', function (event) {    
  var id= $(event.relatedTarget).data('id');
  $.ajax({
    type: 'GET',
    url:`./clientes/${id}/edit`,
    dataType : 'json',
    data: {
      'id' : $(`#id`).val(),
    },
    success: (data)=>{
      $(event.currentTarget).find('#ruc-show').val(data.cliente.ruc);
      $(event.currentTarget).find('#razon_social-show').val(data.cliente.razon_social);
      $(event.currentTarget).find('#telefono-show').val(data.cliente.telefono);
      $(event.currentTarget).find('#tipo-show').val(data.cliente.tipo);
      $(event.currentTarget).find('#direccion-show').val(data.cliente.direccion);
      $(event.currentTarget).find('#linea_credito-show').val(data.cliente.linea_credito);
      //$(event.currentTarget).find('#periocidad-show').val(data.cliente.periocidad);
    },
    error: (error)=>{
      toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
    }
  });
});

$(document).ready(function() {
  $('#tabla-clientes').DataTable({
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

//Cambiar un archivo en general JS en el main
$('.box').on('click',function(){
  $('.box').removeClass('box-success');
  $(this).addClass('box-success');
})