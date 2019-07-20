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
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="ruc-show">RUC</label>
                  <input id="ruc-show" type="text" class="form-control" name="ruc" placeholder="Ingrese su RUC">
                </div>
                <div class="form-group">
                  <label for="razon_social-show">Razon Social</label>
                  <input id="razon_social-show" type="text" class="form-control" name="razon_social" placeholder="Ingrese la Razon Social">
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
                  <label for="tipo-show">Tipo</label>
                  <select id="tipo-show" class="form-control" name="tipo">
                    <option value="1">Grifo</option>
                    <option value="2">Normal</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="direccion-show">Direccion</label>
                  <input id="direccion-show" type="text" class="form-control" name="direccion" placeholder="Ingrese la direccion">
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
  
    