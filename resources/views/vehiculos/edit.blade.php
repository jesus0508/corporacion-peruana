<div class="modal fade" id="modal-edit-vehiculo" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('vehiculo.update',0)}}" method="post" class="modal-content">
      @csrf
      @method('PUT')
      <input id="id-edit" type="hidden" name="id">
      <input id="transportista_id-edit" type="hidden" name="transportista_id">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos del vehiculo</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- left column -->
          
		  <!-- mid column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos Cisterna:</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group @error('placa') has-error @enderror">
                      <label for="placa">PLACA*</label>
                      <input id="placa-edit" type="text" class="form-control" name="placa" placeholder="Ingrese la placa de la cisterna" value="{{ old('placa') }}" pattern="[A-Z]{3}[-]\d{3}" title="Formato: ABC-123" required>
                      @error('placa')
                        <span class="help-block" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>


                  </div>

                  <div class="col-md-6">
                    <div class="form-group @error('capacidad') has-error @enderror">
                      <label for="capacidad">Capacidad - gls</label>
                      <input id="capacidad-edit" type="number" class="form-control" name="capacidad" placeholder="Ingrese la capacidad en galones" value="{{ old('capacidad') }}" min="0" max="999999" required>
                      @error('capacidad')
                      <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>              
                  </div>
                </div>

                <div class="form-group">
                  <label for="detalle_compartimiento">Detalle compartimiento</label>
                  <textarea class="form-control" style="resize: none;" id="detalle_compartimiento-edit" name="detalle_compartimiento" placeholder="Detalle aquí las características del compartimiento ..." rows="3">                   
                  </textarea>
                </div>

              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
   
        </div> 
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success pull-left">Guardar cambios</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
