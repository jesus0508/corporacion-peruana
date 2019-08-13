$('#treeview-proveedores').on('click',function(event){
  $('#treeview-clientes').removeClass("active");
  $('#treeview-pagos').removeClass("active");
  $('#treeview-ventas').removeClass("active");
  $('#treeview-reportes').removeClass("active");
  $('#treeview-transportista').removeClass("active");
  $('#treeview-proveedores').addClass("active");
})


function abrirModal(){
    $('#modal-edit-proveedor').modal('show');
}

function editarProveedor(id){

 $('#modal-edit-proveedor').modal('show');
  //var id = document.getElementById('id_proveedor').value;
  console.log(id);
  $.ajax({
    type: 'GET',
    url:`./proveedores/${id}/edit`,
    dataType : 'json',

    success: (data)=>{
      console.log(data);
      document.getElementById('razon_social-edit').value = data.razon_social;
      document.getElementById('ruc-edit').value = data.ruc;
      document.getElementById('email-edit').value = data.email;
      document.getElementById('id-edit').value = data.id;
    },
    error: (error)=>{
      toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
    }
  }); 
}



$(document).ready(function() {
  
    $('#tabla-proveedores').DataTable({
        "order": [[ 0, "desc" ]],       
          "responsive": true,             
        'language': {
        'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
      }, columnDefs: [ 
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

$("#proveedor").select2();


$('.box').on('click',function(){
  $('.box').removeClass('box-success');
  $(this).addClass('box-success');
})
