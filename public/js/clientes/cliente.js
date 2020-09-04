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
      console.log(data);
      $(event.currentTarget).find('#ruc-edit').val(data.cliente.ruc);
      $(event.currentTarget).find('#razon_social-edit').val(data.cliente.razon_social);
      $(event.currentTarget).find('#cargo-edit').val(data.cliente.cargo);
      $(event.currentTarget).find('#representante-edit').val(data.cliente.representante);
      $(event.currentTarget).find('#dni-edit').val(data.cliente.dni);     
      $(event.currentTarget).find('#correo_cliente-edit').val(data.cliente.correo_cliente);     
      $(event.currentTarget).find('#precio_galon-edit').val(data.cliente.precio_galon);  
      $(event.currentTarget).find('#linea_credito-edit').val(data.cliente.linea_credito);     
      $(event.currentTarget).find('#distrito-edit').val(data.cliente.distrito);     
      $(event.currentTarget).find('#actividad_economica-edit').val(data.cliente.actividad_economica);
      $(event.currentTarget).find('#direccion-edit').val(data.cliente.direccion);     
      $(event.currentTarget).find('#forma_pago-edit').val(data.cliente.forma_pago);  
      $(event.currentTarget).find('#persona_comision-edit').val(data.cliente.persona_comision);     
      $(event.currentTarget).find('#correo_representante-edit').val(data.cliente.correo_representante);     
      $(event.currentTarget).find('#nro_cuenta-edit').val(data.cliente.nro_cuenta);
      $(event.currentTarget).find('#cuenta_detraccion-edit').val(data.cliente.cuenta_detraccion);     
      $(event.currentTarget).find('#utilidades-edit').val(data.cliente.utilidades);  
      $(event.currentTarget).find('#extraordinaria-edit').val(data.cliente.extraordinaria);         
      $(event.currentTarget).find('#telefono-edit').val(data.cliente.telefono);
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
      $(event.currentTarget).find('#cargo-show').val(data.cliente.cargo);
      $(event.currentTarget).find('#representante-show').val(data.cliente.representante);
      $(event.currentTarget).find('#dni-show').val(data.cliente.dni);     
      $(event.currentTarget).find('#correo_cliente-show').val(data.cliente.correo_cliente);     
      $(event.currentTarget).find('#precio_galon-show').val(data.cliente.precio_galon);  
      $(event.currentTarget).find('#linea_credito-show').val(data.cliente.linea_credito);     
      $(event.currentTarget).find('#distrito-show').val(data.cliente.distrito);     
      $(event.currentTarget).find('#actividad_economica-show').val(data.cliente.actividad_economica);
      $(event.currentTarget).find('#direccion-show').val(data.cliente.direccion);     
      $(event.currentTarget).find('#forma_pago-show').val(data.cliente.forma_pago);  
      $(event.currentTarget).find('#persona_comision-show').val(data.cliente.persona_comision);     
      $(event.currentTarget).find('#correo_representante-show').val(data.cliente.correo_representante);     
      $(event.currentTarget).find('#nro_cuenta-show').val(data.cliente.nro_cuenta);
      $(event.currentTarget).find('#cuenta_detraccion-show').val(data.cliente.cuenta_detraccion);     
      $(event.currentTarget).find('#utilidades-show').val(data.cliente.utilidades);  
      $(event.currentTarget).find('#extraordinaria-show').val(data.cliente.extraordinaria);         
      $(event.currentTarget).find('#telefono-show').val(data.cliente.telefono);
    },
    error: (error)=>{
      toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
    }
  });
});

$(document).ready(function() {
  $('#tabla-clientes').DataTable({
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
  function confirmar()
{
  if(confirm('¿Estas seguro de eliminar el cliente?'))
    return true;
  else
    return false;
}