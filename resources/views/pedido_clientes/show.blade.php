<div class="modal fade" id="modal-show-pedido_cliente" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Ver informacion del pedido</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Detalles</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="nro_pedido-show">Número de Pedido</label>
                  <input id="nro_pedido-show" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="fecha_pedido-show">Fecha de Pedido</label>
                    <input id="fecha_pedido-show" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="grifo-show">Grifo</label>
                  <input id="grifo-show" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="fecha_descarga">Fecha para descarga</label>
                  <input id="fecha_descarga" type="text" class="tuiker form-control"
                  name="fecha_descarga" readonly>
                </div>
                <div class="form-group">
                  <label for="horario_descarga-show">Horario para descarga</label>
                  <input id="horario_descarga-show" type="text" class="form-control" readonly>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">DIESEL B5 (S50) UV</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                    <label for="galones-show">Galones</label>
                    <input id="galones-show" type="number" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="precio_galon-show">Precio Galon</label>
                    <input id="precio_galon-show" type="number" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="precio_total-show">Total</label>
                    <input id="precio_total-show" type="number" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="observacion-show">Precio Total</label>
                  <textarea id="observacion-show" type="text" class="form-control" readonly></textarea>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (right) -->
        </div> <!-- /.row-top -->
      </div>
      <div class="modal-footer">
        <button type="" class="btn btn-primary pull-right" data-dismiss="modal">Aceptar</button>
      </div>
    </div><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
    