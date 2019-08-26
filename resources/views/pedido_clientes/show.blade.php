<div class="modal fade" id="modal-show-pedido_cliente" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Ver informacion del pedido</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos Cliente</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="cliente-show">Cliente</label>
                      <input id="cliente-show" type="text" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="ruc-show">RUC</label>
                        <input id="ruc-show" type="text" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="numero-show">Numero</label>
                      <input id="numero-show" type="text" class="form-control" readonly>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
        </div> <!-- /.first-row -->
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Detalles Pedido</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nro_factura-show">Número de Factura</label>
                      <input id="nro_factura-show" type="text" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="fecha_pedido-show">Fecha de Pedido</label>
                      <input id="fecha_pedido-show" type="text" class="form-control" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="fecha_descarga-show">Fecha para descarga</label>
                      <input id="fecha_descarga-show" type="text" class="tuiker form-control"
                      name="fecha_descarga" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="horario_descarga-show">Horario para descarga</label>
                      <input id="horario_descarga-show" type="text" class="form-control" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="observacion-show">Observacion</label>
                      <textarea id="observacion-show" type="text" class="form-control" readonly></textarea>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
        </div>
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">DIESEL B5 (S50) UV</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="galones-show">Galones</label>
                      <input id="galones-show" type="number" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="precio_galon-show">Precio Galon</label>
                      <input id="precio_galon-show" type="number" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="precio_total-show">Total</label>
                      <input id="precio_total-show" type="number" class="form-control" readonly>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (right) -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="" class="btn btn-primary pull-right" data-dismiss="modal">Aceptar</button>
      </div>
    </div><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
    