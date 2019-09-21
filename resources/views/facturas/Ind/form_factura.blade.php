        <div id="datos-pedido" class="box box-success">
          <div class="box-header with-border">
            <div class="row">
                <div class="col-md-4">
                   <h3 class="box-title"> Datos Factura Proveedor</h3>
                </div>
                <div class="col-md-4 pull-right">
                  <button class="btn  btn-success"> 
                    <i class="fa fa-plus-circle">&nbsp;</i>
                     ASIGNAR FACTURA</button>
                </div>
              </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('nro_factura_proveedor') has-error @enderror">
                  <label for="nro_factura">Número de Factura</label>
                  <input id="nro_factura" type="text" class="form-control" 
                          name="nro_factura_proveedor" value="{{ old('nro_factura_proveedor') }}" placeholder="Ingrese el numero de pedido" required>
                    @error('nro_factura_proveedor')
                      <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
           
              </div><!-- /.numero-pedido -->
              <div class="col-md-6">
                <div class="form-group @error('monto_factura') has-error @enderror">
                  <label for="monto_factura">Monto total - Factura</label>
                  <input id="monto_factura" type="text" class="form-control" 
                          name="monto_factura" pattern="(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{2}))?)"
                          title="2 decimales"
                          value="{{ old('monto_factura') }}" 
                          placeholder="Ingrese el monto de la factura" required>
                    @error('monto_factura')
                      <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
              </div><!-- /.grifo -->
            </div><!-- /.first-row -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('fecha_factura_proveedor') has-error @enderror">
                  <label for="fecha_factura_proveedor">Fecha factura</label>
                  <input autocomplete="off" id="fecha_factura" type="text" class="tuiker form-control" value="{{ old('fecha_factura_proveedor') }}"
                  name="fecha_factura_proveedor" placeholder="Ingrese la fecha de la factura"
                  required="" >
                  @error('fecha_factura_proveedor')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

              </div>

            </div><!-- /.second-row -->

          </div><!-- /.box-body -->
        </div><!-- /.box datos factura  -->
     

      
  