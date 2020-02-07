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
                <div class="row">
                  <div class="col-md-6">
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
                  </div>
                  <div class="col-md-6">
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
                  </div>
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

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group @error('administrador') has-error @enderror">
                      <label for="administrador-edit">Representante</label>
                      <input id="administrador-edit" type="text" class="form-control"
                            name="administrador" placeholder="Ingrese el nombre del representante" required >
                      @error('administrador')
                        <span class="help-block" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>                
                  </div>
                  <div class="col-md-6">
                    <div class="form-group @error('dni') has-error @enderror">
                      <label for="dni-edit">DNI</label>
                      <input id="dni-edit" type="number" class="form-control" value="{{old("dni")}}" pattern="[0-9]{8}" title="Formato: 8 dígitos" 
                            name="dni" placeholder="Ingrese DNI">
                      @error('dni')
                      <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row"> 
                  <div class="col-md-4">
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
                  </div>
                  <div class="col-md-4">
                    <div class="form-group @error('telefono') has-error @enderror">
                      <label for="telefono-edit">Teléfono</label>
                      <input id="telefono-edit" type="text" class="form-control"
                              name="telefono" placeholder="Teléfono"
                              pattern="^[0-9]{7,9}">
                      @error('telefono')
                        <span class="help-block" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror                
                    </div>                    
                  </div>
                  <div class="col-md-4">
                   <div class="form-group">
                        <label for="forma_pago-edit">Forma de pago*</label>
                        <select class="form-control" id="forma_pago-edit" name="forma_pago" placeholder="Seleccione la forma de pago" required>
                            <option value="1">Diario</option>
                            <option value="2">Semanal</option>
                            <option value="3">Quincenal</option>
                            <option value="4">Mensual</option>
                        </select>
                    </div>  
                  </div>                  
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group @error('correo_grifo') has-error @enderror">
                      <label for="correo_grifo">Correo</label>
                      <input id="correo_grifo-edit" type="email" class="form-control"
                              name="correo_grifo"   value="{{old('correo_grifo')}}" placeholder="Ingrese correo del grifo " >
                      @error('correo_grifo')
                      <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>  
                  </div>
                  <div class="col-md-6">
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
                  </div>
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
                <div class="form-group @error('direccion') has-error @enderror">
                    <label for="direccion-edit">Dirección</label>
                    <textarea name="direccion" placeholder="Ingrese la direccion"  minlength="5"cols="30"  id="direccion-edit" class="form-control" rows="2">{{old("direccion")}}</textarea>
                    @error('direccion')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
              <div class="row">            
                <div class="col-md-6">
                  <div class="form-group @error('IGV') has-error @enderror">
                    <label for="persona_comision-edit">Persona a tratar comision</label>
                    <input id="persona_comision-edit" type="text" class="form-control" value="{{old("persona_comision")}}"
                            name="persona_comision" placeholder="Ingrese nombre de la persona">
                    @error('persona_comision')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group @error('correo_representante') has-error @enderror">
                    <label for="correo_representante-edit">Correo de persona a tratar</label>
                    <input id="correo_representante-edit" type="email" step="any" class="form-control" value="{{old("correo_representante")}}"
                          name="correo_representante" placeholder="Ingrese el correo del representante">
                    @error('correo_representante')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">                
                <div class="col-md-6">
                  <div class="form-group @error('nro_cuenta') has-error @enderror">
                    <label for="nro_cuenta-edit">Numero de Cuenta</label>
                    <input id="nro_cuenta-edit" type="text" class="form-control" value="{{old("nro_cuenta")}}"  name="nro_cuenta" placeholder="Ingrese el número de cuenta">
                    @error('nro_cuenta')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group @error('cuenta_detraccion') has-error @enderror">
                    <label for="cuenta_detraccion-edit">Cuenta Detraccion</label>
                    <input id="cuenta_detraccion-edit" type="text" step="any" class="form-control" value="{{old("cuenta_detraccion")}}"
                          name="cuenta_detraccion" placeholder="Ingrese cuenta detraccion">
                    @error('cuenta_detraccion')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                            
                <div class="col-md-6">
                  <div class="form-group @error('utilidades') has-error @enderror">
                    <label for="utilidades-edit">Utilidad</label>
                    <input id="utilidades-edit" type="text" class="form-control" value="{{old("utilidades")}}"
                            name="utilidades" placeholder="Forma de pago de las utilidades" >
                    @error('utilidades')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                
                <div class="col-md-6">
                <div class="form-group @error('extraordinaria') has-error @enderror">
                    <label for="extraordinaria-edit">Extraordinaria</label>
                    <input id="extraordinaria-edit" type="text" class="form-control" value="{{old("extraordinaria")}}"
                          name="extraordinaria" placeholder="Ingrese extraordinaria">
                    @error('extraordinaria')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div> 
                <div class="form-group">
                  <label for="zona-edit">Zona</label>
                  <select name="zona" id="select_zonas" class="form-control">
                    <option value="CENTRO">CENTRO</option>
                    <option value="ESTE">ESTE</option>  
                    <option value="NORTE">NORTE</option>
                    <option value="SUR">SUR</option>           
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
