<div class="modal fade" id="modal-edit-cliente" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('clientes.update')}}" method="post" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos del cliente</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
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
                  <label for="razon_social-edit">Razon Social</label>
                  <input id="razon_social-edit" type="text" class="form-control" value=""
                          name="razon_social" placeholder="Ingrese la Razon Social" required>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Datos secundarios</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="tipo-edit">Tipo</label>
                  <select id="tipo-edit" class="form-control" name="tipo">
                    <option value="1">Grifo</option>
                    <option value="2">Normal</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="direccion-edit">Direccion</label>
                  <input id="direccion-edit" type="text" class="form-control" 
                          name="direccion" placeholder="Ingrese la direccion">
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (right) -->
        </div> 
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left">Guardar cambios</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
