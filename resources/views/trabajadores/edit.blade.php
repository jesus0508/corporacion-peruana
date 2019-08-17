<div class="modal fade" id="modal-edit-trabajador" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('trabajadores.update',0)}}" method="post" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos del Trabajador</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h2 class="box-title">Registro Trabajador</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="dni-edit">DNI</label>
                  <input id="dni-edit" type="text" class="form-control" 
                          name="dni" placeholder="Ingrese el dni" required required pattern="^[0-9]{8}">
                </div>
                <div class="form-group">
                  <label for="nombres-edit">Nombres</label>
                  <input id="nombres-edit" type="text" class="form-control" 
                          name="nombres" placeholder="Ingrese sus nombres" required>
                </div>
                <div class="form-group">
                  <label for="apellido_paterno-edit">Apellido Paterno</label>
                  <input id="apellido_paterno-edit" type="text" class="form-control" 
                          name="apellido_paterno" placeholder="Ingrese el apellido paterno" required>
                </div>
                <div class="form-group">
                  <label for="apellido_materno-edit">Apellido Materno</label>
                  <input id="apellido_materno-edit" type="text" class="form-control"
                          name="apellido_materno" placeholder="Ingrese el apellido materno" required>
                </div>
                <div class="form-group">
                  <label for="fecha_nacimiento-edit">Fecha de nacimiento</label>
                  <input id="fecha_nacimiento-edit" type="text" class="form-control" 
                          name="fecha_nacimiento" placeholder="Ingrese la fecha nacimiento" required>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
        
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box">
              <div class="box-header with-border">
                <h2 class="box-title">Datos complementarios</h2>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="email-edit">Correo Electronico</label>
                  <input id="email-edit" type="email" class="form-control" 
                          name="email" placeholder="Ingrese el email">
                </div>
                <div class="form-group">
                  <label for="telefono-edit">Telefono</label>
                  <input id="telefono-edit" type="text" class="form-control" 
                          name="telefono" placeholder="Ingrese el telefono">
                </div>
                <div class="form-group">
                  <label for="genero-edit">Genero</label>
                  <div class="form-inline">
                    <div class="radio">
                      <label>
                        <input id="genero-edit-1" type="radio" name="genero" value="1" required>
                        Masculino
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input id="genero-edit-2" type="radio" name="genero" value="2">
                        Femenino
                      </label>
                    </div>
                  </div>
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
        <input id="id-edit" type="hidden" name="id">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left">Guardar cambios</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
  

