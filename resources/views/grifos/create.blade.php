<div class="row">
  <!-- left column -->
  <form class="" action="{{route('grifos.store')}}" method="post">
    @csrf
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Registro Grifo</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group @error('ruc') has-error @enderror">
                <label for="ruc">RUC</label>
                <input id="ruc" type="text" class="form-control" value="{{old("ruc")}}"
                        name="ruc" placeholder="Ingrese su RUC" required>
                @error('ruc')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('razon_social') has-error @enderror">
                <label for="razon_social">Razón Social</label>
                <input id="razon_social" type="text" class="form-control" value="{{old("razon_social")}}"
                        name="razon_social" placeholder="Ingrese la Razon Social" required>
                @error('razon_social')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group @error('telefono') has-error @enderror">
                <label for="telefono">Teléfono</label>
                <input id="telefono" type="tel" class="form-control" value="{{old("telefono")}}" required
                        name="telefono" placeholder="Ingrese el numero de telefono" pattern="^[0-9]{9}">
                @error('telefono')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('administrador') has-error @enderror">
                <label for="administrador">Administrador</label>
                <input id="administrador" type="text" class="form-control" value="{{old("administrador")}}"
                      name="administrador" placeholder="Ingrese el nombre del administrador" required >
                @error('administrador')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
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
          <div class="row">
            <div class="col-md-6">
              <div class="form-group @error('stock') has-error @enderror">
                <label for="stock">Stock</label>
                <input id="stock" type="number" class="form-control" 
                      name="stock" placeholder="Ingrese el stock">
                @error('stock')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('distrito') has-error @enderror">
                <label for="distrito">Distrito</label>
                <input id="distrito" type="text" class="form-control"
                        name="distrito" placeholder="Ingrese la distrito" >
                @error('distrito')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group @error('direccion') has-error @enderror">
                <label for="direccion">Dirección</label>
                <input id="direccion" type="text" class="form-control"
                        name="direccion" placeholder="Ingrese la direccion" >
                @error('direccion')
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
          Registrar nuevo Grifo
        </button>
      </div>
    </div>
  </form>
</div> <!-- /.row-top -->


