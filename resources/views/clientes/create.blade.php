<div class="row">
  <!-- left column -->
  <form class="" action="{{route('clientes.store')}}" method="post">
    @csrf
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
                <label for="ruc">RUC*</label>
                <input id="ruc" type="text" class="form-control number-validation" value="{{old('ruc')}}" name="ruc" placeholder="Ingrese su RUC" title="Numero de 11 digitos"
                        pattern="[0-9]{11}" maxlength="11" required>
                @error('ruc')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group @error('representante') has-error @enderror">
                <label for="representante">Representante</label>
                <input id="representante" type="text" class="form-control" value="{{old("representante")}}" name="representante" placeholder="Ingrese el nombre del representante" 
                        maxlength="100">
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
                <label for="razon_social">Razón Social*</label>
                <textarea id="razon_social" cols="30" rows="2" class="form-control" name="razon_social" placeholder="Ingrese la razon social"
                          maxlength="120" required>
                          {{old("razon_social")}}
                </textarea>             
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
                <input id="cargo" type="text" class="form-control" value="{{old("cargo")}}" name="cargo" placeholder="Ingrese el cargo" 
                        maxlength="50">
                @error('cargo')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('dni') has-error @enderror">
                <label for="dni">DNI</label>
                <input id="dni" type="text" class="form-control number-validation" value="{{old("dni")}}" name="dni" placeholder="Ingrese DNI"
                        pattern="[0-9]{8}" minlegth="8" maxlength="8" title="Formato: 8 dígitos" >
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
                <label for="telefono">Teléfono</label>
                <input id="telefono" type="tel" class="form-control number-validation" value="{{old("telefono")}}" name="telefono" placeholder="Número de telefono" 
                        pattern="[0-9]{7,9}" title="Formato: 7 u 9 dígitos">
                @error('telefono')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('correo_cliente') has-error @enderror">
                <label for="correo_cliente">Correo cliente</label>
                <input id="correo_cliente" type="email" class="form-control" value="{{old("correo_cliente")}}" name="correo_cliente" placeholder="Ingrese el Correo del cliente" 
                        maxlength="120">
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
                <label for="actividad_economica">Actividad economica</label>
                <textarea id="actividad_economica" cols="30" rows="2" class="form-control" name="actividad_economica" placeholder="Ingrese actividad economica" 
                          maxlength="255">
                  {{old("actividad_economica")}}
                </textarea>          
                @error('actividad_economica')
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
                <label for="linea_credito">Linea de credito*</label>
                <input id="linea_credito" type="number" class="form-control number-validation" value="{{old("linea_credito")}}" name="linea_credito" placeholder="Ingrese la linea de credito" 
                        step="any" min="0" max="99999" required>
                @error('linea_credito')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('distrito') has-error @enderror">
                <label for="distrito">Distrito*</label>
                <input id="distrito" type="text" class="form-control" value="{{old("distrito")}}" name="distrito" placeholder="Ingrese Distrito" 
                        maxlength="255" required>
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
            <div class="col-md-12">
              <div class="form-group @error('direccion') has-error @enderror">
                <label for="direccion">Dirección*</label>
                <textarea name="direccion" placeholder="Ingrese la direccion" cols="30" class="form-control" rows="2"
                          minlength="5" required>
                  {{old("direccion")}}
                </textarea>

                @error('direccion')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('precio_galon') has-error @enderror">
                  <label for="precio_galon">Precio por galon*</label>
                  <input id="precio_galon" type="number" class="form-control number-validation" value="{{old("precio_galon")}}" name="precio_galon" placeholder="Ingrese precio por galon" 
                          step="any" min="1" max="999" required>
                  @error('precio_galon')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('forma_pago') has-error @enderror">
                <label for="forma_pago">Forma de pago*</label>
                <input id="forma_pago" type="text" class="form-control" value="{{old("forma_pago")}}" name="forma_pago" placeholder="Ingrese forma de pago" 
                        minlength="5" maxlength="255">
                @error('forma_pago')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            {{--<div class="col-md-6"> 
              <div class="form-group">
                <label for="forma_pago">Forma de pago*</label>
                <select class="form-control" id="forma_pago" name="forma_pago" placeholder="Seleccione la forma de pago" required>
                    <option value="1">Diario</option>
                    <option value="2">Semanal</option>
                    <option value="3">Quincenal</option>
                    <option value="4">Mensual</option>
                </select>
              </div>            
            </div>--}}         
          </div>
          <div class="row">            
            <div class="col-md-6">
              <div class="form-group @error('persona_comision') has-error @enderror">
                <label for="persona_comision">Persona a tratar comision</label>
                <input id="persona_comision" type="text" class="form-control" value="{{old("persona_comision")}}" name="persona_comision" placeholder="Ingrese nombre de la persona" 
                        maxlength="100">
                @error('persona_comision')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group @error('correo_representante') has-error @enderror">
                <label for="correo_representante">Correo de persona a tratar</label>
                <input id="correo_representante" type="email" class="form-control" value="{{old("correo_representante")}}" name="correo_representante" placeholder="Ingrese el correo del representante"
                        maxlength="120">
                @error('correo_representante')
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
          Registrar nuevo cliente
        </button>
      </div>
    </div>
  </form>
</div> <!-- /.row-top -->


