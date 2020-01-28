<div class="modal fade" id="modal-edit-concepto" style="display: none;">
  <div class="modal-dialog">
    <form class="modal-content" action="{{route('concepto_gastos.update',0)}}" method="post">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" id="id-edit">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar  GASTO </h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="concepto-edit">CATEGORIA</label>
                      <input  type="text" class="form-control"
                           id="categoria-edit-concepto"  readonly="">
                    </div>  
                  </div>
                </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="concepto-edit">SUB-CATEGORIA</label>
                    <input  type="text" class="form-control"
                           id="subcategoria-edit-concepto"  readonly="">
                  </div>  
                </div>
              </div>

                </div>
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group @error('concepto') has-error @enderror">
                      <label for="concepto-edit">GASTO</label>
                      <input  type="text" class="form-control"
                          name="concepto" id="concepto-edit" placeholder="Ingrese el nuevo GASTO" required>
                        @error('concepto')
                          <span class="help-block" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div> 
                  </div>   
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="codigo-concepto-edit">Código</label>
                      <input id="codigo-concepto-edit" type="text" class="form-control"
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
