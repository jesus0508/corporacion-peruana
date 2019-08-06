<div class="row">
  <!-- left column -->
  <form class="" action="{{route('users.store')}}" method="post">
    @csrf
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Registro Usuario</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="form-group @error('nombres') has-error @enderror">
            <label for="nombres">Nombres</label>
            <input id="nombres" type="text" class="form-control" 
                    name="nombres" placeholder="Ingrese sus nombres">
            @error('nombres')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group @error('apellido_materno') has-error @enderror">
                <label for="apellido_materno">Apellido Materno</label>
                <input id="apellido_materno" type="text" class="form-control"
                name="apellido_materno" placeholder="Ingrese el apellido materno">
                @error('apellido_materno')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('apellido_paterno') has-error @enderror">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input id="apellido_paterno" type="text" class="form-control" 
                        name="apellido_paterno" placeholder="Ingrese el apellido paterno">
                @error('apellido_paterno')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group @error('fecha_nacimiento') has-error @enderror">
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input id="fecha_nacimiento" type="text" class="tuiker form-control" 
                    name="fecha_nacimiento" placeholder="Ingrese la fecha nacimiento">
            @error('fecha_nacimiento')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
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
          <div class="form-group @error('email') has-error @enderror">
            <label for="email">Correo Electronico</label>
            <input id="email" type="text" class="form-control" 
                    name="email" placeholder="Ingrese el email">
            @error('email')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group @error('password') has-error @enderror">
            <label for="password">Contraseña</label>
            <input id="password" type="text" class="form-control" 
                    name="password" placeholder="Ingrese la contraseña">
            @error('password')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group @error('telefono') has-error @enderror">
                <label for="telefono">Telefono</label>
                <input id="telefono" type="text" class="form-control" 
                        name="telefono" placeholder="Ingrese el telefono">
                @error('email')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('rol_id') has-error @enderror">
                <label for="rol_id">Rol</label>
                <select id="rol_id" class="form-control" name="rol_id">
                  <option value="1">Administrador</option>
                  <option value="2">Secretaria</option>
                </select>
                @error('rol')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (right) -->

    <div class="col-md-12">
      <div class="form-group">
        <button type="submit" class="btn btn-lg btn-success">
          <i class="fa fa-save"> </i>
          Registrar nuevo Usuario
        </button>
      </div>
    </div>
  </form>
</div> <!-- /.row-top -->