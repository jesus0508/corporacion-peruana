function editarVehiculo(id){

 $('#modal-edit-vehiculo').modal('show');
  //var id = document.getElementById('id_proveedor').value;
  console.log(id);
  $.ajax({
    type: 'GET',
    url:`./${id}/edit`,
    dataType : 'json',
      
    success: (data)=>{
      console.log(data);
      document.getElementById('placa-edit').value = data.placa;
      document.getElementById('capacidad-edit').value = data.capacidad;
      document.getElementById('detalle_compartimiento-edit').value = data.detalle_compartimiento;
      document.getElementById('transportista_id-edit').value = data.transportista_id;      
      document.getElementById('id-edit').value = data.id;
    },
    error: (error)=>{
      toastr.error('Ocurrio al cargar los datos', 'Error Alert', {timeOut: 2000});
    }
  }); 
}



$(document).ready(function() {
 

  $('#tabla-vehiculos').DataTable({
    "order": [[ 0, "desc" ]]
  });
} );



