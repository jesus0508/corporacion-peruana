<div class="modal fade" id="modal-edit-categoria" style="display: none;">
  <div class="modal-dialog">
    <form class="modal-content" action="{{route('categoria_gastos.update',0)}}" method="post">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" id="id-edit-categoria">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar  Categoría </h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group @error('categoria') has-error @enderror">
                      <label for="categoria-edit">CATEGORÍA</label>
                      <input  type="text" class="form-control"
                          name="categoria" id="categoria-edit" placeholder="Ingrese la nueva CATEGORÍA" required>
                        @error('categoria')
                          <span class="help-block" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div> 
                  </div>   
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="codigo-edit">Código</label>
                      <input id="codigo-edit-categoria" type="text" class="form-control"
                          name="codigo"  readonly="">
                    </div>
                  </div>               
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-success pull-left"><span class="fa fa-save"></span>&nbsp; Guardar</button>

                <button type="" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                
              </div>
            </div><!-- /.box -->
          </div>  
        </div> 
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
