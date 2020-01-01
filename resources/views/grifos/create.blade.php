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
                <input id="ruc" type="text" class="form-control" value="{{old('ruc')}}"
                        name="ruc" placeholder="Ingrese su RUC">
                @error('ruc')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>          
            <div class="col-md-6">
              <div class="form-group @error('precio_galon') has-error @enderror">
                <label for="precio_galon">Precio Galón*</label>
                <input id="precio_galon" type="text" class="form-control" value="{{old('precio_galon')}}"
                        name="precio_galon" placeholder="Precio de galón" required>
                @error('precio_galon')
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
                <label for="razon_social">Razón Social*</label>
                <textarea id="razon_social" 
                cols="30" rows="2" class="form-control" 
                name="razon_social" placeholder="Ingrese la razon social"
                  >{{old("razon_social")}}</textarea>             
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
                <input id="telefono" type="text" class="form-control" value="{{old('telefono')}}"
                      name="telefono" placeholder="Ingrese el numero de celular" pattern="^[0-9]{9}">
                @error('telefono')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('administrador') has-error @enderror">
                <label for="administrador">Administrador*</label>
                <input id="administrador" type="text" class="form-control" 
                    value="{{old('administrador')}}"  name="administrador" placeholder="Ingrese el nombre del administrador" required >
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
                <label for="stock">Stock*</label>
                <input id="stock" type="number" class="form-control" step="any" min="0" 
                      name="stock"   value="{{old('stock')}}" placeholder="Ingrese el stock" required="">
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
                        name="distrito"  value="{{old('distrito')}}" placeholder="Ingrese la distrito" >
                @error('distrito')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group @error('correo') has-error @enderror">
                <label for="correo">Correo</label>
                <input id="correo" type="email" class="form-control"
                        name="correo"   value="{{old('correo')}}" placeholder="Ingrese correo electrónico de contacto" >
                @error('correo')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-4"> 
              <div class="form-group">
                <label for="zona">Zona*</label>
                <select class="form-control" id="zona" name="zona" placeholder="Seleccione la zona" required>
                    <option value="NORTE">NORTE</option>
                    <option value="SUR">SUR</option>
                    <option value="ESTE">ESTE</option>
                </select>
              </div>            
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group @error('direccion') has-error @enderror">
                <label for="direccion">Dirección</label>
                <textarea name="direccion" placeholder="Ingrese la direccion" minlength="5"cols="30" class="form-control" rows="2">{{old("direccion")}}</textarea>

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
      <div class="form-group pull-right">
        <button type="submit" class="btn btn-lg btn-success">
          <i class="fa fa-save"> </i>
          Registrar nuevo Grifo
        </button>
      </div>
    </div>
  </form>
</div> <!-- /.row-top -->


