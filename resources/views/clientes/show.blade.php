<div class="modal fade" id="modal-show-cliente" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Ver datos del cliente</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="ruc-show">RUC</label>
                  <input id="ruc-show" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="razon_social-show">Razón Social</label>
                  <input id="razon_social-show" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="telefono-show">Teléfono</label>
                  <input id="telefono-show" type="tel" class="form-control" readonly>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos secundarios</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="linea_credito-show">Linea de credito</label>
                  <input id="linea_credito-show" type="number" step="any" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="direccion-show">Dirección</label>
                  <input id="direccion-show" type="text" class="form-control" readonly>
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
  
    