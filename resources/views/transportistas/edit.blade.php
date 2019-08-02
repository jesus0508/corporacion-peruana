<div class="modal fade" id="modal-edit-transportista" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('transportista.update',0)}}" method="post" class="modal-content">
      @csrf
      @method('PUT')
      <input id="id-edit" type="hidden" name="id">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos del transportista</h4>
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

                  <label for="nombre_transportista-edit">Nombre transportista*</label>
                  <input id="nombre_transportista-edit" type="text" class="form-control"
                          name="nombre_transportista" placeholder="Ingrese su nombre_transportista" required>
                </div>
                <div class="form-group">
                  <label for="brevete-edit">Brevete*</label>
                  <input id="brevete-edit" type="text" class="form-control"
                          name="brevete" placeholder="Ingrese la Razon Social" required>
                </div>
                <div class="form-group">
                  <label for="celular_transportista-edit">Celular</label>
                  <input id="celular_transportista-edit" type="tel" class="form-control"
                          name="celular_transportista" placeholder="Ingrese el numero telefonico" required>
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
