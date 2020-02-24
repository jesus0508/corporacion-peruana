<div class="modal fade" id="modal-edit-categoria" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar    Categoría </h4>
      </div>
      <div class="modal-body">
      <form class="modal-content" action="{{route('categoria_ingresos.update',0)}}" method="post">
      @csrf
      @method('PUT')
        <input type="hidden" id="id-edit" name="id">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group @error('categoria') has-error @enderror">
                      <label for="categoria-add">CATEGORÍA Ingreso</label>
                      <input  type="text" class="form-control" id="categoria" 
                          name="categoria" placeholder="Ingrese la CATEGORÍA" required>
                        @error('categoria')
                          <span class="help-block" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div> 
                  </div>

                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn  btn-primary pull-left"><span class="fa fa-save"></span>&nbsp; Guardar</button>
                <button type="" class="btn  btn-default pull-right" data-dismiss="modal">Cancelar</button>
                
              </div>
            </div><!-- /.box -->
          </div>  
        </div> 
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
