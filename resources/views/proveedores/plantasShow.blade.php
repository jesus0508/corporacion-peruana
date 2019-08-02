<script type="text/javascript">
  
 $("#btn-prueba").click(function(e){
 alert('se abrió');
  e.preventDefault();
 
   

  });
</script>
 <div class="modal fade" id="modal-show-plantas" tabindex="-1" role="dialog" style="display: none;" >
  <div class="modal-dialog" style="width: 500px;">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <center><input align="center" id="razon_social-show" class="btn btn-success" 
              name="razon_social" style="font-size: 20px;" disabled> </center>    
      </div>

      <div class="modal-body show-plantas">

          <h2>AGREGUE UNA PLANTA PRIMERO</h2>
        
        

       
      </div>
      <div class="modal-footer">
        <button type="" class="btn btn-lg-default" data-dismiss="modal">Cancelar</button>
        </div>
  
  </div>  <!-- modal-content --> 
  </div><!-- /.modal-dialog -->
</div>

 <script>
   function mi_funcion(){

        
 
        var id_planta = $("input[name=id]").val();
        //id_planta = 5;
        alert(id_planta);
        var planta = $("input[name=planta]").val();

        var direccion_planta = $("input[name=direccion_planta]").val();

        var celular_planta = $("input[name=celular_planta]").val();

         $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
}); 

        $.ajax({

          type    : 'POST', 
          url:`planta_update/`+planta,
          

          data:{id:id_planta, planta:planta, direccion_planta:direccion_planta, celular_planta:celular_planta},
          dataType: 'json', 
            encode  : true,

          success:function(data){
              alert(data.success);

           },
           
          error: function (data) {
                console.log('Error:', data);
            }

        });

  }
</script>