<div class="modal fade" id="modal-edit-grifo" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('grifos.update',0)}}" method="post" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos del Grifo</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="ruc-edit">RUC</label>
                  <input id="ruc-edit" type="text" class="form-control"
                          name="ruc" placeholder="Ingrese su RUC" required>
                </div>
                <div class="form-group">
                  <label for="razon_social-edit">Razón Social</label>
                  <input id="razon_social-edit" type="text" class="form-control"
                          name="razon_social" placeholder="Ingrese la Razon Social" required>
                </div>
                <div class="form-group">
                  <label for="telefono-edit">Teléfono</label>
                  <input id="telefono-edit" type="tel" class="form-control"
                          name="telefono" placeholder="Ingrese el numero telefonico" required>
                </div>
                <div class="form-group">
                  <label for="administrador-edit">Administrador</label>
                  <input id="administrador-edit" type="text" class="form-control"
                        name="administrador" placeholder="Ingrese el nombre del administrador" required >
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos secundarios</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="stock-edit">Stock</label>
                  <input id="stock-edit" type="number" class="form-control" 
                        name="stock" placeholder="Ingrese el stock">
                </div>
                <div class="form-group">
                  <label for="distrito-edit">Distrito</label>
                  <input id="distrito-edit" type="text" class="form-control" 
                          name="distrito" placeholder="Ingrese la distrito" >
                </div>
                <div class="form-group">
                  <label for="direccion-edit">Dirección</label>
                  <input id="direccion-edit" type="text" class="form-control" 
                          name="direccion" placeholder="Ingrese la direccion">
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (right) -->
        </div> 
        <input id="id-edit" type="hidden" name="id">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left">Guardar cambios</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
