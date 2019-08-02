<div class="modal fade" id="modal-edit-vehiculo" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('vehiculo.update',0)}}" method="post" class="modal-content">
      @csrf
      @method('PUT')
      <input id="id-edit" type="hidden" name="id">
      <input id="transportista-edit" type="hidden" name="transportista">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos del vehiculo</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- left column -->
          
		  <!-- mid column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">

                  <label for="placa-edit"> Placa*</label>
                  <input id="placa-edit" type="text" class="form-control"
                          name="placa" placeholder="Ingrese su placa" required>
                </div>
                <div class="form-group">
                  <label for="modelo-edit">Modelo</label>
                  <input id="modelo-edit" type="text" class="form-control"
                          name="modelo" placeholder="Ingrese el modelo" required>
                </div>
                <div class="form-group">
                  <label for="marca-edit">Marca</label>
                  <input id="marca-edit" type="tel" class="form-control"
                          name="marca" placeholder="Ingrese la marca" required>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
   
        </div> 
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success pull-left">Guardar cambios</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
