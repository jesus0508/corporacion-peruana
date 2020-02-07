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
      //console.log(data);
      $(event.currentTarget).find('#ruc-edit').val(data.grifo.ruc);
      $(event.currentTarget).find('#razon_social-edit').val(data.grifo.razon_social);
      $(event.currentTarget).find('#telefono-edit').val(data.grifo.telefono);
      $(event.currentTarget).find('#administrador-edit').val(data.grifo.administrador);
      $(event.currentTarget).find('#stock-edit').val(data.grifo.stock);
      $(event.currentTarget).find('#distrito-edit').val(data.grifo.distrito);
      $(event.currentTarget).find('#direccion-edit').val(data.grifo.direccion);
      $(event.currentTarget).find('#id-edit').val(data.grifo.id);
      $(event.currentTarget).find('#dni-edit').val(data.grifo.dni);
      $(event.currentTarget).find('#precio_galon-edit').val(data.grifo.precio_galon);
      $(event.currentTarget).find('#correo_grifo-edit').val(data.grifo.correo_grifo);
      $(event.currentTarget).find('#select_zonas').val(data.grifo.zona);
      $(event.currentTarget).find('#forma_pago-edit').val(data.grifo.forma_pago);  
      $(event.currentTarget).find('#persona_comision-edit').val(data.grifo.persona_comision);     
      $(event.currentTarget).find('#correo_representante-edit').val(data.grifo.correo_representante);     
      $(event.currentTarget).find('#nro_cuenta-edit').val(data.grifo.nro_cuenta);
      $(event.currentTarget).find('#cuenta_detraccion-edit').val(data.grifo.cuenta_detraccion);     
      $(event.currentTarget).find('#utilidades-edit').val(data.grifo.utilidades);  
      $(event.currentTarget).find('#extraordinaria-edit').val(data.grifo.extraordinaria); 
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
      //console.log(data);
      $(event.currentTarget).find('#ruc-show').val(data.grifo.ruc);
      $(event.currentTarget).find('#razon_social-show').val(data.grifo.razon_social);
      $(event.currentTarget).find('#telefono-show').val(data.grifo.telefono);
      $(event.currentTarget).find('#administrador-show').val(data.grifo.administrador);
      $(event.currentTarget).find('#stock-show').val(data.grifo.stock);
      $(event.currentTarget).find('#distrito-show').val(data.grifo.distrito);
      $(event.currentTarget).find('#direccion-show').val(data.grifo.direccion);
      $(event.currentTarget).find('#dni-show').val(data.grifo.dni);
      $(event.currentTarget).find('#precio_galon-show').val(data.grifo.precio_galon);
      $(event.currentTarget).find('#correo_grifo-show').val(data.grifo.correo_grifo);
      $(event.currentTarget).find('#zona-show').val(data.grifo.zona);   
      $(event.currentTarget).find('#forma_pago-show').val(data.grifo.forma_pago);  
      $(event.currentTarget).find('#persona_comision-show').val(data.grifo.persona_comision);     
      $(event.currentTarget).find('#correo_representante-show').val(data.grifo.correo_representante);     
      $(event.currentTarget).find('#nro_cuenta-show').val(data.grifo.nro_cuenta);
      $(event.currentTarget).find('#cuenta_detraccion-show').val(data.grifo.cuenta_detraccion);     
      $(event.currentTarget).find('#utilidades-show').val(data.grifo.utilidades);  
      $(event.currentTarget).find('#extraordinaria-show').val(data.grifo.extraordinaria);   
    },
    error: (error)=>{
      toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
    }
  });
});
  function inicializarSelect2($select, text, data) {
    $select.select2({
      placeholder: text,
      allowClear: true,
      data: data
    });
  }
$(document).ready(function() {
  $('#tabla-grifos').DataTable({
    responsive: false,
    scrollX: true,
    columnDefs: [ 
    { orderable: false, targets: [ -1 ] },
    { searchable: false, targets: [-1] },
  ] 
  });
  } 
);
  function confirmar()
{
  if(confirm('¿Estas seguro de eliminar el Grifo?'))
    return true;
  else
    return false;
}