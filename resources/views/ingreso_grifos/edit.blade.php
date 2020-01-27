<div class="modal fade" id="modal-edit-ingreso-grifo" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('ingreso_grifos.update',0)}}" method="post" class="modal-content">
      @csrf
      @method('PUT')
      <input type="hidden" id="id-edit" name="id">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Modificar Ingreso Grifo</h4>
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
                      <input autocomplete="off" id="fecha_ingreso-edit" type="text" class="tuiker form-control"
                        name="fecha_ingreso" placeholder="Fecha de Ingreso">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="fecha_reporte-edit">Fecha de Reporte: </label>
                      <input autocomplete="off" id="fecha_reporte-edit" type="text" class="tuiker form-control"
                        name="fecha_reporte" placeholder="Fecha de Reporte" readonly="">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="seletc-grifos-edit">Grifo</label>
                      <select class="form-control" id="seletc-grifos-edit" name="grifo_id" readonly="" >
                        @foreach($grifos as $grifo)
                        <option value="{{$grifo->id}}">{{$grifo->razon_social}}</option>
                        @endforeach
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
                <div id="lecturas-edit" class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="lectura_inicial-edit">Lectura Inicial</label>
                      <input id="lectura_inicial-edit" type="text" class="form-control" autocomplete="off"
                              name="lectura_inicial" placeholder="Ingrese la lectura inicial" required min="0">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="lectura_final-edit">Lectura Final</label>
                      <input id="lectura_final-edit" type="text" class="form-control"
                              name="lectura_final" placeholder="Ingrese la lectura final" required min="0">
                    </div>
                  </div>
                </div>
                <div id="total-galones" class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="galones">Venta de Galones</label>
                      <input id="galones-edit" type="text" step="any" class="form-control"
                              name="galones" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="calibracion">Calibracion</label>
                      <input id="calibracion-edit" type="number" step="any" class="form-control"
                              name="calibracion" placeholder="Ingrese la calibracion" 
                              value="0"  min="0">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-group">
                        <label for="precio_galon">Precio x Galones</label>
                        <input id="precio_galon-edit" type="number" step="any" class="form-control" 
                                name="precio_galon" placeholder="Ingrese el precio por galon" required min="0" readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="monto_ingreso">Total</label>
                      <input id="monto_ingreso-edit" class="form-control" 
                              name="monto_ingreso" readonly>
                    </div>
                  </div>
                </div>
                <input id="grifo-id-edit" type="hidden" name="grifo-id">                
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
        </div> 
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success pull-left">Actualizar Ingreso</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
