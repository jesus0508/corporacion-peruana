<div class="modal fade" id="modal-create-user" style="display: hidden;">
  <div class="modal-dialog">
    <form action="{{ route('users.store') }}" method="post" class="modal-content">
      @csrf
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Crear cuenta</h4>
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

                  <label for="email">Email*</label>
                  <input id="email" type="text" class="form-control"
                          name="email" placeholder="Ingrese el email" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="password">Contraseña</label>
                  <input id="password" type="text" class="form-control"
                          name="password" placeholder="Ingrese la Contraseña" required>
                </div>
                <div class="form-group">
                  <label for="role_id">Rol</label>
                  <select id="role_id" class="form-control" name="role_id">
                    <option value="1">Administrador</option>
                    <option value="2">Secretaria</option>
                    <option value="3">Saca tu Gaaa</option>
                  </select>
                </div>
                <input id="trabajador_id" type="hidden" name="trabajador_id">
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
  