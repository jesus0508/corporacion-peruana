<div class="row">
    <div class="col-md-8">     

        <div id="datos-pedido" class="box box-success">
          <div class="box-header with-border">
            <div class="row">
                <div class="col-md-4">
                   <h3 class="box-title"> Datos Pago</h3>
                </div>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group @error('fecha_pago') has-error @enderror">
                  <label for="fecha_pago"> Fecha*</label>
                  <input id="fecha_pago" type="text" class="form-control" 
                          name="fecha_pago" value="{{$pago_transportista->fecha_pago}}" readonly="">
                  @error('fecha_pago')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
           
              </div><!-- /.numero-pedido -->
              <div class="col-md-4">
                <div class="form-group @error('monto_descuento') has-error @enderror">
                  <label for="monto_descuento">Monto Descontado (S/.)</label>
                  <input id="monto_descuento" type="number" class="form-control" 
                          name="monto_descuento" value="{{$desc - $pago_transportista->pendiente_dejado}}" placeholder="Ingrese monto a descontar" readonly="">
                  @error('monto_descuento')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div><!-- /.grifo -->

              <div class="col-md-4">
                <div class="form-group @error('total_faltante') has-error @enderror">
                  <label for="total_faltante"> Total Faltantes (S/.)</label>
                  <input id="total_faltante" type="text" class="form-control" 
                          value="{{number_format((float)
                        $desc, 2, '.', '')}}" readonly="">
                  @error('total_faltante')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div><!-- /.grifo -->
            </div><!-- /.first-row -->
            <div class="row">
              <div class="col-md-8">
                <div class="form-group @error('observacion') has-error @enderror">
                  <label for="observacion"> Observacion</label>
                  <textarea class="form-control" name="observacion" cols="30" rows="2" readonly="">
                    {{$pago_transportista->observacion}}
                  </textarea>
                  @error('observacion')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group @error('pendiente_dejado') has-error @enderror">
                  <label for="pendiente_dejado">Monto dejado como pendiente</label>
                  <input id="monto_pendiente" type="text" class="form-control" 
                          name="pendiente_dejado" value="{{$pago_transportista->pendiente_dejado}}" readonly="">
                  @error('pendiente_dejado')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div><!-- /.grifo -->
            </div><!-- /.second-row -->

          </div><!-- /.box-body -->
        </div><!-- /.box datos factura  -->
      </div> <!-- Fin col-md-8 -->     
      <div class="col-md-4">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"> Cálculo Pago</h3>
          </div>
          <div class="box-body">  
            <div class="row">
              <div class="col-lg-6">
                <label for="costo_galon">Pendiente Descuento S/. &nbsp;(anterior)</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="descuento_pendiente_anterior" value="{{$transportista->descuento_pendiente-$pago_transportista->pendiente_dejado}}" type="text" class="form-control" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label for="subtotal"> SubTotal</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="subtotal" value="{{$subtotal}}" type="text" class="form-control" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label for="planta_AR">Descuento por faltantes actuales (-)</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="descuento_calculo" type="text"  class="form-control" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label for="galones"><b>TOTAL PAGADO
                </b> </label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input style="color:red; font-weight: bold; font-size: 15px;" id="total_pago" name="monto_total_pago"  type="text" class="form-control" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- Fin col md 4-->
  </form>
</div> <!-- /.row-top -->
