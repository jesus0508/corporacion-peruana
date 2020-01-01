$select_zonas = $('#select_zonas');
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
      console.log(data);
      $(event.currentTarget).find('#ruc-edit').val(data.grifo.ruc);
      $(event.currentTarget).find('#razon_social-edit').val(data.grifo.razon_social);
      $(event.currentTarget).find('#telefono-edit').val(data.grifo.telefono);
      $(event.currentTarget).find('#administrador-edit').val(data.grifo.administrador);
      $(event.currentTarget).find('#stock-edit').val(data.grifo.stock);
      $(event.currentTarget).find('#distrito-edit').val(data.grifo.distrito);
      $(event.currentTarget).find('#direccion-edit').val(data.grifo.direccion);
      $(event.currentTarget).find('#id-edit').val(data.grifo.id);
      $(event.currentTarget).find('#precio_galon-edit').val(data.grifo.precio_galon);
      $(event.currentTarget).find('#correo-edit').val(data.grifo.correo);
      $(event.currentTarget).find('#zona-edit').val(data.grifo.zona);
        let zona = data.grifo.zona;        
        let lista_zonas = '';
        data.zonas.forEach((zona) => {
          lista_zonas += `<option value="${zona.zona}">${zona.zona}</option>`;
        });
        $select_zonas.html(lista_zonas);
        $select_zonas.val(zona);
        //inicializarSelect2($select_zonas, 'Seleccione la zona');
        //$select_zonas.val(zona).trigger('change');

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
      $(event.currentTarget).find('#precio_galon-show').val(data.grifo.precio_galon);
      $(event.currentTarget).find('#correo-show').val(data.grifo.correo);
      $(event.currentTarget).find('#zona-show').val(data.grifo.zona);   
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