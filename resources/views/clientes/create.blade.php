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
              <div class="form-group @error('cargo') has-error @enderror">
                <label for="cargo">Cargo</label>
                <input id="cargo" type="text" class="form-control" value="{{old("cargo")}}"
                        name="cargo" placeholder="Ingrese la cargo">
                @error('cargo')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group @error('representante') has-error @enderror">
                <label for="representante">Representante</label>
                <input id="representante" type="text" step="any" class="form-control" value="{{old("representante")}}"
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
          <div class="col-md-6">
           <div class="form-group @error('dni') has-error @enderror">
                <label for="dni">DNI</label>
                <input id="dni" type="text" step="any" class="form-control" value="{{old("dni")}}"
                      name="dni" placeholder="Ingrese DNI">
                @error('dni')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          <div class="col-md-6">
              <div class="form-group @error('telefono') has-error @enderror">
                <label for="telefono">Teléfono</label>
                <input id="telefono" type="tel" class="form-control" value="{{old("telefono")}}"
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
            
            <div class="col-md-6">
              <div class="form-group @error('correo_cliente') has-error @enderror">
                <label for="correo_cliente">Correo cliente</label>
                <input id="correo_cliente" type="mail" class="form-control" value="{{old("correo_cliente")}}"
                        name="correo_cliente" placeholder="Ingrese la Correo del cliente">
                @error('Correo_cliente')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group @error('actividad_economica') has-error @enderror">
                <label for="actividad_economica">Actividad economica</label>
                <input id="actividad_economica" type="text" step="any" class="form-control" value="{{old("actividad_economica")}}"
                      name="actividad_economica" placeholder="Ingrese actividad economica">
                @error('actividad_economica')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            
            
            
            <div class="col-md-6">
            <div class="form-group @error('precio_galon') has-error @enderror">
                <label for="precio_galon">Precio por galon</label>
                <input id="precio_galon" type="number" step="any" class="form-control" value="{{old("precio_galon")}}"
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
            <div class="col-md-6">
              <div class="form-group @error('distrito') has-error @enderror">
                <label for="distrito">Distrito</label>
                <input id="distrito" type="text" step="any" class="form-control" value="{{old("distrito")}}"
                      name="distrito" placeholder="Ingrese Distrito" required>
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
            <div class="col-md-6">
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
            <div class="col-md-6"> 
              <div class="form-group">
                <label for="forma_pago">forma_pago</label>
                <select class="form-control" id="forma_pago" name="forma_pago" placeholder="Seleccione la forma de pago" required>
                    <option value="Diario">Diario</option>
                    <option value="Semanal">Semanal</option>
                    <option value="Quincenal">Quincenal</option>
                    <option value="Mensual">Mensual</option>
                </select>
              </div>            
            </div>

            

          </div>

          <div class="row">
            
            <div class="col-md-6">
              <div class="form-group @error('IGV') has-error @enderror">
                <label for="persona_comision">Persona a tratar comision</label>
                <input id="persona_comision" type="text" class="form-control" value="{{old("persona_comision")}}"
                        name="persona_comision" placeholder="Ingrese nombre de la persona">
                @error('persona_comision')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group @error('correo_comision') has-error @enderror">
                <label for="correo_comision">Correo de persona a tratar</label>
                <input id="correo_comision" type="mail" step="any" class="form-control" value="{{old("correo_comision")}}"
                      name="correo_comision" placeholder="Ingrese el correo de la persona">
                @error('correo_comision')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            
            <div class="col-md-6">
              <div class="form-group @error('numero_cuenta') has-error @enderror">
                <label for="numero_cuenta">Numero de Cuenta</label>
                <input id="numero_cuenta" type="text" class="form-control" value="{{old("numero_cuenta")}}"
                        name="numero_cuenta" placeholder="Ingrese el número de cuenta">
                @error('numero_cuenta')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group @error('cuenta_detraccion') has-error @enderror">
                <label for="cuenta_detraccion">Cuenta Detraccion</label>
                <input id="cuenta_detraccion" type="text" step="any" class="form-control" value="{{old("cuenta_detraccion")}}"
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
                <label for="utilidades">Utilidad</label>
                <input id="utilidades" type="text" class="form-control" value="{{old("utilidades")}}"
                        name="utilidades" placeholder="Ingrese la forma de pago de las utilidades" required minlength="5">
                @error('utilidades')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            
            <div class="col-md-6">
            <div class="form-group @error('extraordinaria') has-error @enderror">
                <label for="extraordinaria">Extraordinaria</label>
                <input id="extraordinaria" type="mail" step="any" class="form-control" value="{{old("extraordinaria")}}"
                      name="extraordinaria" placeholder="Ingrese extraordinaria" required min="0">
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


