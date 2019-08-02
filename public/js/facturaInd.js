 $("#monto_factura").on('change',function(){
    var monto=$("#monto_factura").val();
    var total=$("#total").val();

    if(monto>0 && total>0){
      var diferencia = total-monto;
     // Math.round(diferencia*100)/100;
      diferencia = parseFloat(diferencia).toFixed(2);
      
      
      if( diferencia < 0 ){
        var dif = document.getElementById('diferencia');
          dif.style.backgroundColor = "#e53935";
          dif.style.color = "black";
       }else{
          var dif = document.getElementById('diferencia');
          dif.style.backgroundColor = "#4caf50";
          dif.style.color = "black";

       }


      $('#diferencia').val(diferencia);
    

    }else{
      var dif = document.getElementById('diferencia');
      dif.style.backgroundColor = "#eee";
      dif.style.color = "#555";
      $('#diferencia').val(''); 
      




    }

  });


$(document).ready(function() { 

  $("#placa").prop("selectedIndex", -1);

  $("#placa").select2({
    placeholder: "Seleccione la placa",
    allowClear:true
  });

  $("#placa").on('change',function(){
    var id=$("#placa").val();

    if(id){//id del proveedor

      findByPlaca(id);

    }else{
      $('#nombre_transportista').val('');
      $('#modelo').val('');
      $('#marca').val('');
    }

  });

});

function findByPlaca(id){
  $.ajax({
    type: 'GET',
    url:`../transportista/${id}`,
    success: (data)=>{
      console.log(data);
      $('#nombre_transportista').val(data.transportista.nombre_transportista);
      $('#modelo').val(data.modelo);
      $('#marca').val(data.marca);

    }
  });
}