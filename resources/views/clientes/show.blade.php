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
                  <div class="form-group">
                    <label for="ruc-show">RUC*</label>
                    <input id="ruc-show" type="text" class="form-control" readonly="">
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="representante-show">Representante</label>
                    <input id="representante-show" type="text" class="form-control" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="razon_social-show">Razón Social*</label>
                    <textarea id="razon_social-show" 
                    cols="30" rows="2" class="form-control"                     
                      readonly=""></textarea>             
                  </div> 
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="cargo-show">Cargo</label>
                    <input id="cargo-show" type="text" class="form-control" readonly="" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="dni-show">DNI</label>
                    <input id="dni-show" type="number" class="form-control" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="telefono-show">Teléfono</label>
                    <input id="telefono-show" type="tel" class="form-control" readonly="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="correo_cliente-show">Correo cliente</label>
                    <input id="correo_cliente-show" type="email" class="form-control" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">          
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="actividad_economica-show">Actividad economica</label>
                    <textarea id="actividad_economica-show" 
                    cols="30" rows="2" class="form-control" 
                    readonly=""></textarea>          
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="precio_galon-show">Precio por galon*</label>
                      <input id="precio_galon-show" type="number" class="form-control" readonly="">
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
                    <input id="linea_credito-show" type="number" class="form-control"
                      readonly="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="distrito-show">Distrito*</label>
                    <input id="distrito-show" type="text" step="any" class="form-control" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
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
                  <div class="form-group">
                    <label for="persona_comision-show">Persona a tratar comision</label>
                    <input id="persona_comision-show" type="text" class="form-control" readonly="">
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-groupo">
                    <label for="correo_representante-show">Correo de persona a tratar</label>
                    <input id="correo_representante-show" type="email" step="any" class="form-control" readonly="">
                  </div>
                </div>
              </div>

              <div class="row">
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nro_cuenta-show">Numero de Cuenta</label>
                    <input id="nro_cuenta-show" type="text" class="form-control"  readonly="">
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="cuenta_detraccion-show">Cuenta Detraccion</label>
                    <input id="cuenta_detraccion-show" type="text" class="form-control"
                          readonly="">
                  </div>
                </div>
              </div>
              <div class="row">           
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="utilidades-show">Utilidad*</label>
                    <input id="utilidades-show" type="text" class="form-control"
                          readonly="" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="extraordinaria-show">Extraordinaria*</label>
                    <input id="extraordinaria-show" type="text" class="form-control" readonly="">
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
