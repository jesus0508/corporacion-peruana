//$('#fecha_factura').val($.datepicker.formatDate('d/m/yy', new Date()));
$('#fecha_factura').datepicker({
   // minDate: 0,
  });

    $("#monto_factura").on('change',function(){
    var monto=$("#monto_factura").val();
    var total=$("#total").val();

    if(monto>0 && total>0){
      var diferencia = monto-total;
     // Math.round(diferencia*100)/100;
      diferencia = parseFloat(diferencia).toFixed(2);
      
      
      if( diferencia > 0 ){
        var dif = document.getElementById('diferencia');
          dif.style.backgroundColor = "#e53935";
          dif.style.color = "black";
       }else if( diferencia == 0 ) {
          var dif = document.getElementById('diferencia');
          dif.style.backgroundColor = "#eee";
          dif.style.color = "#555";

       } else{
           var dif = document.getElementById('diferencia');
          dif.style.backgroundColor = "#4caf50";
          dif.style.color = "black";
       }
       diferencia = -1 * diferencia;
       

      $('#diferencia').val(diferencia);
    

    }else{
      var dif = document.getElementById('diferencia');
      dif.style.backgroundColor = "#eee";
      dif.style.color = "#555";
      $('#diferencia').val('');       
    }

  });

$(document).ready(function() { 

  $("#nro_pedido").prop("selectedIndex", -1);

  $("#nro_pedido").select2({
    placeholder: "Ingresa el número de pedido",
    allowClear:true
  });

  $("#nro_pedido").on('change',function(){
    var id=$("#nro_pedido").val();

    if(id){//id del proveedor

      findByNroPedido(id);

    }else{
      $('#scop').val('');
      $('#costo_galon').val('');
      $('#galones').val('');
      $('#total').val('');
      $('#planta_AR').val('');
      $('#fecha_pedido').val('');
      $('#pedido_asignar_transportista').val('');
      var  div1 = document.getElementById('datos-pedido');
       div1.style.display = 'block';
    }

  });



});


function findByNroPedido(id){
  $.ajax({
    type: 'GET',
    url:`../factura_proveedor/${id}`,
    success: (data)=>{
      //console.log(data);
      $('#scop').val(data.scop);
      $('#costo_galon').val(data.costo_galon);
      $('#galones').val(data.galones);
      var  montoTotal = parseFloat(data.galones*data.costo_galon).toFixed(2);
      $('#total').val( montoTotal );
      $('#planta_AR').val(data.planta.planta);
      $('#pedido_asignar_transportista').val(data.id);
      if( data.factura_proveedor_id != null ){
       var  div1 = document.getElementById('datos-pedido');
       div1.style.display = 'none';
       
      }
     //console.log( getFormattedDate( data.created_at ) );
      $('#fecha_pedido').val( getFormattedDate( data.created_at ) );
    }
  });
}


function getFormattedDate(date) {
     var date2 = new Date(date);
     var year = date2.getFullYear();
     var month = (1 + date2.getMonth()).toString();
     month = month.length > 1 ? month : '0' + month;
     var day = date2.getDate().toString();
     day = day.length > 1 ? day : '0' + day;
     return day + '/' + month + '/' +  year ;
}

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