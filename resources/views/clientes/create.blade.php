<div class="row">
  <!-- left column -->
  <form class="" action="{{route('clientes.store')}}" method="post">
    @csrf
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Registro Cliente</h3>
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
          </div>
          <div class="row">
            <div class="col-md-12">
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
            <div class="col-md-12">
              <div class="form-group @error('linea_credito') has-error @enderror">
                <label for="linea_credito">Linea de credito</label>
                <input id="linea_credito" type="number" step="any" class="form-control" value="{{old("linea_credito")}}"
                      name="linea_credito" placeholder="Ingrese la linea de credito" required min="0">
                @error('linea_credito')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            {{-- <div class="col-md-6">
              <div class="form-group @error('periocidad') has-error @enderror">
                <label for="tipo">Periocidad</label>
                <input id="periocidad" type="number" class="form-control" value="{{old("periocidad")}}"
                      name="periocidad" placeholder="Ingrese la periocidad" required min="0">
                @error('periocidad')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div> --}}
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group @error('direccion') has-error @enderror">
                <label for="direccion">Dirección</label>
                <input id="direccion" type="text" class="form-control" value="{{old("direccion")}}"
                        name="direccion" placeholder="Ingrese la direccion" required minlength="5">
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
          Registrar nuevo cliente
        </button>
      </div>
    </div>
  </form>
</div> <!-- /.row-top -->


