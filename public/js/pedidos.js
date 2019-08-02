
$(document).ready(function() {

    $('#modal-edit-pedido-proveedor').on('show.bs.modal',function(event){
   // $("#planta-edit").val(-1);
  var nro_pedido= $(event.relatedTarget).data('nro_pedido');
  var scop= $(event.relatedTarget).data('scop');
  var galones= $(event.relatedTarget).data('galones');
  var planta= $(event.relatedTarget).data('planta');
  var costo_galon= $(event.relatedTarget).data('costo_galon');

  $(event.currentTarget).find('#nro_pedido-edit').val(nro_pedido);
  $(event.currentTarget).find('#scop-edit').val(scop);
  $(event.currentTarget).find('#galones-edit').val(galones);
  $(event.currentTarget).find('#planta-edit').val(planta).trigger('change.select2');
  $(event.currentTarget).find('#costo_galon-edit').val(costo_galon);
  $(event.currentTarget).find('#monto_total').val(costo_galon*galones);
  });
});

 

$(document).ready(function() { 

  $("#planta-edit").select2({
    placeholder: "Ingresa la planta",
    allowClear:true
  });
  
  $("#planta").prop("selectedIndex", -1);

  $("#planta").select2({
    placeholder: "Ingresa la planta",
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
    url:`proveedores/${id}`,
    success: (data)=>{
      console.log(data);
      $('#proveedor').val(data.razon_social);
    }
  });
}


$(document).ready(function() {


   $("#galones-edit").on('change',function(){
    var galones=$("#galones-edit").val();
    var costo_galon=$("#costo_galon-edit").val();
   
    //console.log(costo_galon);
    if(galones>0 && costo_galon>0){
       
      var totalMonto = costo_galon*galones;
     // Math.round(diferencia*100)/100;
      totalMonto = parseFloat(totalMonto).toFixed(2);

      $('#monto_total').val(totalMonto);
    
    }else{
      $('#monto_total').val('');
   
    }

  });

   $("#costo_galon-edit").on('change',function(){
    var galones=$("#galones-edit").val();
    var costo_galon=$("#costo_galon-edit").val();

    if(galones>0 && costo_galon>0){
      var totalMonto = costo_galon*galones;
     // Math.round(diferencia*100)/100;
      totalMonto = parseFloat(totalMonto).toFixed(2);
      $('#monto_total').val(totalMonto);
    
    }else{
      $('#monto_total').val('');
    }

  });
});