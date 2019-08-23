<div class="modal fade" id="modal-create-ingreso" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('ingreso_grifos.store')}}" method="post" class="modal-content pago">
      @csrf
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Registrar Ingreso Grifo</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos del Grifo</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="fecha_ingreso">Fecha de Ingreso: </label>
                      <input autocomplete="off" id="fecha_ingreso" type="text" class="tuiker form-control"
                        name="fecha_ingreso" placeholder="Fecha de Ingreso">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="seletc-grifos">Grifo</label>
                      <select class="form-control" id="seletc-grifos" name="grifo_id" required>
                      </select>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
        </div> 
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div id="lecturas" class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="lectura_inicial">Lectura Inicial</label>
                      <input id="lectura_inicial" type="text" class="form-control" autocomplete="off"
                              name="lectura_inicial" placeholder="Ingrese la lectura inicial" required min="0">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="lectura_final">Lectura Final</label>
                      <input id="lectura_final" type="text" class="form-control"
                              name="lectura_final" placeholder="Ingrese la lectura final" required min="0">
                    </div>
                  </div>
                </div>
                <div id="total-galones" class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="venta">Venta de Galones</label>
                      <input id="venta" type="number" step="any" class="form-control"
                              name="venta" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="calibracion">Calibracion</label>
                      <input id="calibracion" type="number" step="any" class="form-control"
                              name="calibracion" placeholder="Ingrese la calibracion" required min="0">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-group">
                        <label for="precio_galon">Precio x Galones</label>
                        <input id="precio_galon" type="number" step="any" class="form-control" 
                                name="precio_galon" placeholder="Ingrese el precio por galon" required min="0">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="total">Total</label>
                      <input id="total" type="number" step="any" class="form-control" 
                              name="total" readonly>
                    </div>
                  </div>
                </div>
                <input id="grifo-id" type="hidden" name="grifo-id">                
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
        </div> 
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left">Registrar Ingreso</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
