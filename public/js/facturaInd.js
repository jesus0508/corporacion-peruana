 $('#fecha_factura').val($.datepicker.formatDate('d/m/yy', new Date()));
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

