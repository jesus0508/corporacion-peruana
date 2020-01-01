<div class="modal fade" id="modal-edit-grifo" style="display: none;">
  <div class="modal-dialog modal-lg">
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
                <div class="form-group  @error('ruc') has-error @enderror">
                  <label for="ruc-edit">RUC</label>
                  <input id="ruc-edit" type="text" class="form-control"
                          name="ruc" placeholder="Ingrese su RUC">
                  @error('ruc')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror                   
                </div>
                <div class="form-group @error('precio_galon') has-error @enderror">
                  <label for="precio_galon-edit">Precio Galón*</label>
                  <input id="precio_galon-edit" type="text" class="form-control" value="{{old('precio_galon')}}"
                          name="precio_galon" placeholder="Precio de galón" required>
                  @error('precio_galon')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group @error('razon_social') has-error @enderror">
                    <label for="razon_social-edit">Razón Social*</label>
                    <textarea id="razon_social-edit" 
                    cols="30" rows="2" class="form-control" 
                    name="razon_social" placeholder="Ingrese la razon social"
                      >{{old("razon_social")}}</textarea>             
                    @error('razon_social')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div> 
                <div class="form-group @error('telefono') has-error @enderror">
                  <label for="telefono-edit">Teléfono</label>
                  <input id="telefono-edit" type="text" class="form-control"
                          name="telefono" placeholder="Ingrese el teléfono"
                          pattern="^[0-9]{7,9}">
                  @error('telefono')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror                
                </div>
                <div class="form-group @error('administrador') has-error @enderror">
                  <label for="administrador-edit">Administrador</label>
                  <input id="administrador-edit" type="text" class="form-control"
                        name="administrador" placeholder="Ingrese el nombre del administrador" required >
                  @error('administrador')
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
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos secundarios</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group @error('stock') has-error @enderror">
                  <label for="stock-edit">Stock</label>
                  <input id="stock-edit" step="any" min="0" type="number" class="form-control" 
                        name="stock" placeholder="Ingrese el stock" required>
                  @error('stock')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group @error('correo') has-error @enderror">
                  <label for="correo">Correo</label>
                  <input id="correo-edit" type="email" class="form-control"
                          name="correo"   value="{{old('correo')}}" placeholder="Ingrese correo electrónico de contacto" >
                  @error('correo')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group @error('distrito') has-error @enderror">
                  <label for="distrito-edit">Distrito</label>
                  <input id="distrito-edit" type="text" class="form-control" 
                          name="distrito" placeholder="Ingrese la distrito" >
                  @error('distrito')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group @error('direccion') has-error @enderror">
                    <label for="direccion-edit">Dirección</label>
                    <textarea name="direccion" placeholder="Ingrese la direccion" required minlength="5"cols="30"  id="direccion-edit" class="form-control" rows="2">{{old("direccion")}}</textarea>
                    @error('direccion')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="zona-edit">Zona</label>
                  <select name="zona" id="select_zonas" class="form-control">
                    
                  </select>

                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (right) -->
        </div> 
        <input id="id-edit" type="hidden" name="id">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success pull-left">Guardar cambios</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
