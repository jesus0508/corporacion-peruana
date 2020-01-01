$('#treeview-transportistas').on('click',function(event){
  $('#treeview-clientes').removeClass("active");
  $('#treeview-pagos').removeClass("active");
  $('#treeview-ventas').removeClass("active");
  $('#treeview-reportes').removeClass("active");
  $('#treeview-transportistas').addClass("active");
})


function editarTransportista(id){

 $('#modal-edit-transportista').modal('show');
  //var id = document.getElementById('id_proveedor').value;
  console.log(id);
  $.ajax({
    type: 'GET',
    url:`./transportista/${id}`,
    dataType : 'json',
      
    success: (data)=>{
      console.log(data.celular_transportista);
      document.getElementById('nombre_transportista-edit').value = data.nombre_transportista;
      document.getElementById('ruc-edit').value = data.ruc;
      document.getElementById('celular_transportista-edit').value = data.celular_transportista;
      document.getElementById('id-edit').value = data.id;
    },
    error: (error)=>{
      toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
    }
  }); 
}



$(document).ready(function() {
  //$("#transportista").prop("selectedIndex", -1);
  
  $("#transportista").select2();
  } );

$(document).ready(function() {
 

  $('#tabla-transportistas').DataTable({
    "order": [[ 0, "desc" ]],
    'columnDefs': [ 
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
} );