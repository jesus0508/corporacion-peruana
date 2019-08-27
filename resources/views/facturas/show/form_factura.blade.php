        <div id="datos-pedido" class="box box-success">
          <div class="box-header with-border">
            <div class="row">
                <div class="col-md-4">
                   <h3 class="box-title"> Datos Factura Proveedor</h3>
                </div>
                <div class="col-md-4 pull-right">
             
                </div>
              </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="nro_factura">Número de Factura</label>
                  <input id="nro_factura" type="text" class="form-control" 
                          name="nro_factura_proveedor" value="{{$pedido->facturaProveedor->nro_factura_proveedor}}" readonly="">
                </div>
           
              </div><!-- /.numero-pedido -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="monto_factura">Monto total - Factura</label>
                  <input id="monto_factura" type="text" class="form-control" 
                          name="monto_factura" value="{{$pedido->facturaProveedor->monto_factura}}" readonly="">
                </div>
              </div><!-- /.grifo -->
            </div><!-- /.first-row -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fecha_factura_proveedor">Fecha factura</label>
                  <input class="form-control" value="{{ date( 'd/m/Y', strtotime( $pedido->facturaProveedor->fecha_factura_proveedor ) ) }}" readonly="">
                </div>
              </div>

            </div><!-- /.second-row -->

          </div><!-- /.box-body -->
        </div><!-- /.box datos factura  -->
     

      
  