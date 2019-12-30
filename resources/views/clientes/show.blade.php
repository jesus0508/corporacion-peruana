<div class="modal fade" id="modal-show-cliente" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Mostrar datos del cliente</h4>
      </div>
         <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h2 class="box-title">Cliente</h2>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group @error('ruc') has-error @enderror">
                    <label for="ruc-show">RUC*</label>
                    <input id="ruc-show" type="text" class="form-control" value="{{old('ruc')}}" pattern="[0-9]{11}" title="Formato: 11 dígitos"  name="ruc" readonly="" placeholder="Ingrese su RUC">
                    @error('ruc')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group @error('representante') has-error @enderror">
                    <label for="representante-show">Representante</label>
                    <input id="representante-show" type="text" class="form-control" value="{{old("representante")}}"
                          name="representante" readonly="" placeholder="Ingrese representante">
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
                    <label for="razon_social-show">Razón Social*</label>
                    <textarea id="razon_social-show" 
                    cols="30" rows="2" class="form-control" 
                    name="razon_social" readonly="" placeholder="Ingrese la razon social"
                      readonly="">{{old("razon_social")}}</textarea>             
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
                    <label for="cargo-show">Cargo</label>
                    <input id="cargo-show" type="text" class="form-control" value="{{old("cargo")}}" readonly=""
                            name="cargo" readonly="" placeholder="Ingrese la cargo">
                    @error('cargo')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group @error('dni') has-error @enderror">
                    <label for="dni-show">DNI</label>
                    <input id="dni-show" type="number" class="form-control" value="{{old("dni")}}" pattern="[0-9]{8}" title="Formato: 8 dígitos" 
                          name="dni" readonly="" placeholder="Ingrese DNI">
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
                    <label for="telefono-show">Teléfono</label>
                    <input id="telefono-show" type="tel" class="form-control" value="{{old("telefono")}}"
                            name="telefono" readonly="" placeholder="Número de telefono" pattern="[0-9]{7,9}">
                    @error('telefono')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group @error('correo_cliente') has-error @enderror">
                    <label for="correo_cliente-show">Correo cliente</label>
                    <input id="correo_cliente-show" type="email" class="form-control" value="{{old("correo_cliente")}}"
                            name="correo_cliente" readonly="" placeholder="Ingrese el Correo del cliente">
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
                    <label for="actividad_economica-show">Actividad economica</label>
                    <textarea id="actividad_economica-show" 
                    cols="30" rows="2" class="form-control" 
                    name="actividad_economica" readonly="" placeholder="Ingrese actividad economica">{{old("actividad_economica")}}</textarea>          
                    @error('actividad_economica')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group @error('precio_galon') has-error @enderror">
                      <label for="precio_galon-show">Precio por galon*</label>
                      <input id="precio_galon-show" type="number" step="any" min="1" class="form-control" value="{{old("precio_galon")}}"
                            name="precio_galon" readonly="" placeholder="Ingrese precio por galon" >
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
                  <div class="form-group">
                    <label for="linea_credito-show">Linea de credito*</label>
                    <input id="linea_credito-show" type="number" step="any" class="form-control" value="{{old("linea_credito")}}"
                          name="linea_credito" readonly="" placeholder="Ingrese la linea de credito" min="0">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group @error('distrito') has-error @enderror">
                    <label for="distrito-show">Distrito*</label>
                    <input id="distrito-show" type="text" step="any" class="form-control" value="{{old("distrito")}}"
                          name="distrito" readonly="" placeholder="Ingrese Distrito">
                    @error('distrito')
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
                          name="periocidad" readonly="" placeholder="Ingrese la periocidad" readonly min="0">
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
                    <label for="direccion-show">Dirección*</label>
                    <textarea name="direccion-show" readonly="" placeholder="Ingrese la direccion"  minlength="5"cols="30" id="direccion-show" class="form-control" rows="2">{{old("direccion")}}</textarea>

                    @error('direccion')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6"> 
                  <div class="form-group">
                    <label for="forma_pago-show">Forma de pago*</label>
                    <select class="form-control" id="forma_pago-show" name="forma_pago" disabled="" placeholder="Seleccione la forma de pago">
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
                  <div class="form-group @error('IGV') has-error @enderror">
                    <label for="persona_comision-show">Persona a tratar comision</label>
                    <input id="persona_comision-show" type="text" class="form-control" value="{{old("persona_comision")}}"
                            name="persona_comision" readonly="" placeholder="Ingrese nombre de la persona">
                    @error('persona_comision')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group @error('correo_representante') has-error @enderror">
                    <label for="correo_representante-show">Correo de persona a tratar</label>
                    <input id="correo_representante-show" type="email" step="any" class="form-control" value="{{old("correo_representante")}}"
                          name="correo_representante" readonly="" placeholder="Ingrese el correo del representante">
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
                    <label for="nro_cuenta-show">Numero de Cuenta</label>
                    <input id="nro_cuenta-show" type="text" class="form-control" value="{{old("nro_cuenta")}}"  name="nro_cuenta" readonly="" placeholder="Ingrese el número de cuenta">
                    @error('nro_cuenta')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group @error('cuenta_detraccion') has-error @enderror">
                    <label for="cuenta_detraccion-show">Cuenta Detraccion</label>
                    <input id="cuenta_detraccion-show" type="text" step="any" class="form-control" value="{{old("cuenta_detraccion")}}"
                          name="cuenta_detraccion" readonly="" placeholder="Ingrese cuenta detraccion">
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
                    <label for="utilidades-show">Utilidad*</label>
                    <input id="utilidades-show" type="text" class="form-control" value="{{old("utilidades")}}"
                            name="utilidades" readonly="" placeholder="Forma de pago de las utilidades"  minlength="5">
                    @error('utilidades')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group @error('extraordinaria') has-error @enderror">
                    <label for="extraordinaria-show">Extraordinaria*</label>
                    <input id="extraordinaria-show" type="text" class="form-control" value="{{old("extraordinaria")}}"
                          name="extraordinaria" readonly="" placeholder="Ingrese extraordinaria"  min="0">
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
      <div class="modal-footer">
   
        <button type="" class="btn btn-default pull-right" data-dismiss="modal">Aceptar</button>
      </div>
    </div><!-- /.end-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
