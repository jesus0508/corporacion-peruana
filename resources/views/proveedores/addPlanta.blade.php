 <div class="modal fade" id="modal-agregar-planta" style="display: none;">
  <div class="modal-dialog" style="width: 500px;">
 

    <form action="{{route('planta.store')}}" method="post" class="modal-content">
      @csrf
     
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <center><input align="center" id="razon_social-add" class="btn btn-success" 
              name="razon_social" style="font-size: 20px;" disabled> </center>    
      </div>
      <div class="modal-body">



        <div class="row">


    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Datos de la planta</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        {{-- <form role="form"> --}}
          <div class="box-body">

            <input type="hidden" id="proveedor_id-add" name="proveedor_id">

            <div class="form-group">
                <label for="planta">Planta</label>
               <input id="planta" type="text" class="form-control" name="planta" placeholder="Ingrese planta" required>           
            </div>
            <div class="form-group">
                <label for="direccion_planta">Ingrese la dirección de la planta</label>
               <input id="direccion_planta" type="text" class="form-control" name="direccion_planta" placeholder="Ingrese dirección ">
           
            </div>
            


            

          </div><!-- /.box-body -->
        {{-- </form> --}}
      </div><!-- /.box -->
    </div>


    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Datos secundarios</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        {{-- <form role="form"> --}}
          <div class="box-body">
          
            <div class="form-group">
                <label for="celular_planta">Celular de la planta</label>
               <input id="celular_planta" type="text" class="form-control" name="celular_planta" placeholder="Ingrese el celular">
           
            </div>
       

          </div><!-- /.box-body -->
        {{-- </form> --}}
      </div><!-- /.box -->
    </div>    
      

        </div> 
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success pull-left">Agregar</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </for><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
