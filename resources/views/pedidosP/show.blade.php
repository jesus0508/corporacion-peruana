<div class="modal fade" id="modal-show-pedido" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Ver datos del pedido</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales</h3>
              </div><!-- /.box-header -->
              <div class="box-body">

                <div class="form-group">
                  <label for="nro_factura-show">NUMERO DE FACTURA </label>
                  <input id="nro_factura-show" type="text" class="form-control" name="nro_factura" disabled>
                </div>
                
                <div class="form-group">
                  <label for="nro_pedido-show">Número de pedido</label>
                  <input id="nro_pedido-show" type="text" class="form-control" name="nro_pedido" disabled>
                </div>
                <div class="form-group">
                  <label for="scop-show">SCOP </label>
                  <input id="scop-show" type="text" class="form-control" name="scop" disabled>
                </div>

                <div class="form-group">
                  <label for="planta-show">PLANTA </label>
                  <input id="planta-show" type="text" class="form-control" name="planta" disabled>
                </div>

                  <div class="form-group">
                  <label for="estado-show">ESTADO </label>
                  <input id="estado-show" type="text" class="form-control" name="estado" disabled>
                </div>

                  


              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
          
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Datos secundarios</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                 <div class="form-group">
                  <label for="fecha_factura_proveedor-show">Fecha factura </label>
                  <input id="fecha_factura_proveedor-show" type="text" class="form-control" name="fecha_factura_proveedor" disabled>
                </div>

                 <div class="form-group">
                  <label for="galones-show"> Galones  </label>
                  <input id="galones-show" type="text" class="form-control" name="galones" disabled>
                </div>

                 <div class="form-group">
                  <label for="costo_galon-show"> Costo galón  </label>
                  <input id="costo_galon-show" type="text" class="form-control" name="costo_galon" disabled>
                </div>

                 <div class="form-group">
                  <label for="costo_total-show"> Costo total </label>
                  <input id="costo_total-show" type="text" class="form-control" name="costo_total"  disabled>
                </div>

                <div class="form-group">
                  <label for="placa-show"> Placa Vehiculo </label>
                  <input id="placa-show" type="text" class="form-control" name="placa"  disabled>
                </div>
            
            
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (right) -->

          
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-rigth" data-dismiss="modal">Aceptar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
  
    