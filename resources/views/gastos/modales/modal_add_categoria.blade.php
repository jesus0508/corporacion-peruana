<div class="modal fade" id="modal-add-categoria" style="display: none;">
  <div class="modal-dialog">
    <form class="modal-content" action="{{route('categoria_gastos.store')}}" method="post">
    @csrf
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Agregar nueva Categoría </h4>
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
                      <label for="categoria-add">CATEGORÍA</label>
                      <input  type="text" class="form-control"
                          name="categoria" placeholder="Ingrese la nueva CATEGORÍA" required>
                        @error('categoria')
                          <span class="help-block" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div> 
                  </div>   
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="codigo-add">Código</label>
                      <input id="codigo-add" type="text" class="form-control"
                          name="codigo"  readonly="">
                    </div>
                  </div>               
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-lg btn-success pull-left"><span class="fa fa-plus"></span>&nbsp; Añadir</button>

                <button type="" class="btn btn-lg btn-default pull-right" data-dismiss="modal">Cancelar</button>
                
              </div>
            </div><!-- /.box -->
          </div>  
        </div> 
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
