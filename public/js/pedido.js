$(document).ready(function() { 

  $("#planta").prop("selectedIndex", -1);

  $("#planta").select2({
    placeholder: "Ingresa la razon social",
    allowClear:true
  });

  $("#planta").on('change',function(){
    var id=$("#planta").val();

    if(id){//id del proveedor

      findByPlanta(id);

    }else{
      $('#proveedor').val('');
    }

  });

});

function findByPlanta(id){
  $.ajax({
    type: 'GET',
    url: 'public/proveedores/'+id,
    success: (data)=>{
      console.log(data);
      $('#proveedor').val(data.razon_social);
    }
  });
}

$('#modal-process-pedido').on('show.bs.modal', function (event) {          
  var id = $(event.relatedTarget).data().id;
  var costo_total = $(event.relatedTarget).data().costo_total;
  var saldo = $(event.relatedTarget).data().saldo;

  $(event.currentTarget).find('#costo_total-process').val(costo_total);
  $(event.currentTarget).find('#saldo-process').val(saldo);
})

$('#modal-edit-pedido').on('show.bs.modal', function (event) {          
  var id = $(event.relatedTarget).data().id;
  var nro_pedido = $(event.relatedTarget).data().nro_pedido;
  var scop = $(event.relatedTarget).data().scop;
  var planta = $(event.relatedTarget).data().planta;
  var fecha_despacho = $(event.relatedTarget).data().fecha_despacho;
  var galones = $(event.relatedTarget).data().galones;
  var costo_galon = $(event.relatedTarget).data().costo_galon;

  $(event.currentTarget).find('#nro_pedido-edit').val(nro_pedido);
  $(event.currentTarget).find('#scop-edit').val(scop);
  $(event.currentTarget).find('#planta-edit').val(planta);
  $(event.currentTarget).find('#fecha_despacho-edit').val(fecha_despacho);
  $(event.currentTarget).find('#galones-edit').val(galones);
  $(event.currentTarget).find('#costo_galon-edit').val(costo_galon);
})

$('#modal-show-pedido').on('show.bs.modal', function (event) {    
  var id = $(event.relatedTarget).data().id;
  var nro_pedido = $(event.relatedTarget).data().nro_pedido;
  var scop = $(event.relatedTarget).data().scop;
  var planta = $(event.relatedTarget).data().planta;
  var fecha_despacho = $(event.relatedTarget).data().fecha_despacho;
 // fecha_despacho = fecha_despacho.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
  var galones = $(event.relatedTarget).data().galones;
  var costo_galon = $(event.relatedTarget).data().costo_galon;
  var costo_total = $(event.relatedTarget).data().costo_total;
  var estado = $(event.relatedTarget).data().estado;
  var nro_factura = $(event.relatedTarget).data().nro_factura;

  $(event.currentTarget).find('#nro_pedido-show').val(nro_pedido);
  $(event.currentTarget).find('#scop-show').val(scop);
  $(event.currentTarget).find('#planta-show').val(planta);
  $(event.currentTarget).find('#fecha_despacho-show').val(fecha_despacho);
  $(event.currentTarget).find('#galones-show').val(galones);
  $(event.currentTarget).find('#costo_galon-show').val(costo_galon);
  $(event.currentTarget).find('#costo_total-show').val(costo_total);
  $(event.currentTarget).find('#estado-show').val(estado);
  $(event.currentTarget).find('#nro_factura-show').val(nro_factura);
})

