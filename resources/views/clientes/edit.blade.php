<div class="modal fade" id="modal-edit-cliente" style="display: none;">
  <div class="modal-dialog modal-lg">
    <form action="{{route('clientes.update',0)}}" method="post" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos del cliente</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h2 class="box-title">Registro Cliente</h2>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group @error('ruc') has-error @enderror">
                    <label for="ruc-edit">RUC*</label>
                    <input id="ruc-edit" type="text" class="form-control" value="{{old('ruc')}}" pattern="[0-9]{11}" title="Formato: 11 dígitos"  name="ruc" placeholder="Ingrese su RUC" required>
                    @error('ruc')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group @error('representante') has-error @enderror">
                    <label for="representante-edit">Representante</label>
                    <input id="representante-edit" type="text" class="form-control" value="{{old("representante")}}"
                          name="representante" placeholder="Ingrese representante">
                    @error('representante')
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
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group @error('cargo') has-error @enderror">
                    <label for="cargo-edit">Cargo</label>
                    <input id="cargo-edit" type="text" class="form-control" value="{{old("cargo")}}"
                            name="cargo" placeholder="Ingrese el cargo">
                    @error('cargo')
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
                <div class="col-md-6">
                  <div class="form-group @error('telefono') has-error @enderror">
                    <label for="telefono-edit">Teléfono</label>
                    <input id="telefono-edit" type="tel" class="form-control" value="{{old("telefono")}}"
                            name="telefono" placeholder="Número de telefono" pattern="[0-9]{7,9}">
                    @error('telefono')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group @error('correo_cliente') has-error @enderror">
                    <label for="correo_cliente-edit">Correo cliente</label>
                    <input id="correo_cliente-edit" type="email" class="form-control" value="{{old("correo_cliente")}}"
                            name="correo_cliente" placeholder="Ingrese el Correo del cliente">
                    @error('correo_cliente')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">          
                <div class="col-md-12">
                  <div class="form-group @error('actividad_economica') has-error @enderror">
                    <label for="actividad_economica-edit">Actividad economica</label>
                    <textarea id="actividad_economica-edit" 
                    cols="30" rows="2" class="form-control" 
                    name="actividad_economica" placeholder="Ingrese actividad economica">{{old("actividad_economica")}}</textarea>          
                    @error('actividad_economica')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group @error('precio_galon') has-error @enderror">
                      <label for="precio_galon-edit">Precio por galon*</label>
                      <input id="precio_galon-edit" type="number" step="any" min="1" class="form-control" value="{{old("precio_galon")}}"
                            name="precio_galon" placeholder="Ingrese precio por galon" required>
                      @error('precio_galon')
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
                  <div class="form-group @error('linea_credito') has-error @enderror">
                    <label for="linea_credito-edit">Linea de credito*</label>
                    <input id="linea_credito-edit" type="number" step="any" class="form-control" value="{{old("linea_credito")}}"
                          name="linea_credito" placeholder="Ingrese la linea de credito" required min="0">
                    @error('linea_credito')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group @error('distrito') has-error @enderror">
                    <label for="distrito-edit">Distrito*</label>
                    <input id="distrito-edit" type="text" step="any" class="form-control" value="{{old("distrito")}}"
                          name="distrito" placeholder="Ingrese Distrito" required>
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
                    <label for="direccion-edit">Dirección*</label>
                    <textarea name="direccion" placeholder="Ingrese la direccion" required minlength="5"cols="30"  id="direccion-edit" class="form-control" rows="2">{{old("direccion")}}</textarea>

                    @error('direccion')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6"> 
                  <div class="form-group @error('forma_pago') has-error @enderror">
                    <label for="forma_pago-edit">Forma de pago*</label>
                    <input type="text" id="forma_pago-edit" name="forma_pago" placeholder="Escriba la forma de pago" class="form-control" required="">
                    @error('forma_pago')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>            
                </div>         
              </div>
              <div class="row">            
                <div class="col-md-6">
                  <div class="form-group @error('persona_comision') has-error @enderror">
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
                    <label for="extraordinaria-edit">Extraordinaria*</label>
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

              

            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!--/.col (right) -->
        </div> {{-- end.row --}}
        <input id="id-edit" type="hidden" name="id">
      </div> {{-- modal.body --}}
      <div class="modal-footer">
        <div class="row">
          <div class="col-md-2"> 
            <button type="submit" class="btn btn-success">Guardar cambios</button>            
          </div>
          <div class="col-md-10">
          </div>
          <div class="col-md-2 pull-right">
            <button type="" class="btn btn-default " data-dismiss="modal">Cancelar</button>   
          </div>
        </div>
      </div>  
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
