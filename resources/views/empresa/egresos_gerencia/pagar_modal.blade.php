<div class="modal fade" id="modal-pagar-gastos" style="display: none;">
  <div class="modal-dialog ">
    <form action="{{route('egreso_gerencia.showGastosPago')}}" method="get" class="modal-content">
      @csrf
      @method('GET')
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Pagar Gastos</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h2 class="box-title">Datos Pago</h2>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group @error('fecha_egreso') has-error @enderror">
                      <label for="fecha_egreso">Fecha egreso</label>
                      <input id="fecha_egreso" autocomplete="off" type="text" class="form-control" name="fecha_egreso" placeholder="Ingrese fecha de egreso" required>
                      @error('fecha_egreso')
                      <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group @error('fecha_reporte') has-error @enderror">
                      <label for="fecha_reporte">Fecha Reporte</label>
                      <input autocomplete="off" id="fecha_reporte"   type="text"  class="form-control"  
                            name="fecha_reporte" placeholder="Ingrese fecha reporte">
                      @error('fecha_reporte')
                      <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group @error('monto_pago') has-error @enderror">
                      <label for="monto_pago">Monto a pagar</label>
                      <input id="monto_pago" type="number" class="form-control" value="{{old("monto_pago")}}" step="any" min="0" 
                            name="monto_pago" placeholder="Ingrese monto pago">
                      @error('monto_pago')
                      <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                </div> 
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group @error('detalle') has-error @enderror">
                      <label for="detalle">Descripción</label>
                      <input id="detalle" type="text" class="form-control" value="{{old("detalle")}}" 
                            name="detalle" placeholder="Ingrese la descripción">
                      @error('detalle')
                      <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>                  
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (right) -->
        </div> {{-- end.row --}}
      </div> {{-- modal.body --}}
      <div class="modal-footer">
        <div class="row">
          <div class="col-md-2"> 
            <button type="submit" class="btn btn-success">Pagar</button>            
          </div>
          <div class="col-md-10">
          </div>
          <div class="col-md-2 pull-right">
            <button type="" class="btn btn-default " data-dismiss="modal">Cancelar</button>   
          </div>
        </div>
      </div>  
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
