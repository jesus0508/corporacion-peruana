<div class="modal fade" id="modal-edit-transporte" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('transporte.update',0)}}" method="POST" class="modal-content">
      @csrf
      @method('PUT')
      <input id="id-edit" type="hidden" name="id">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos del transporte</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group @error('placa') has-error @enderror">
                      <label for="tipo">Tipo de Transporte</label>
                      <select id="tipo-edit" class="form-control" name="tipo" required="">
                        <option value="1">Autos</option>
                        <option value="2">Buses</option>
                        <option value="3">Cisternas</option>
                        <option value="4">Unidades</option>                             
                      </select>
                    </div>
                  </div>              
                  <div class="col-md-7">
                    <div class="form-group @error('placa') has-error @enderror">
                      <label for="placa">Placa</label>
                      <input id="placa-edit" type="text" class="form-control" 
                      value="{{old('placa')}}"   pattern="[A-Za-z]{3}[-]\d{3}" 
                      title="Formato: ABC-123"     
                       name="placa"
                        placeholder="Ejemplo: ABC-123" required>
                      @error('placa')
                      <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group @error('chofer') has-error @enderror">
                      <label for="chofer">Chofer</label>
                      <input id="chofer-edit" type="text" class="form-control" value="{{old('chofer')}}"
                              name="chofer" placeholder="Ingrese el combre completo del conductor" >
                      @error('chofer')
                      <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>                  
                </div>              
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
        </div> 
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left">Guardar cambios</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
