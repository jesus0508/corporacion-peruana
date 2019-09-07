<div class="modal fade" id="modal-add-subcategoria" style="display: none;">
  <div class="modal-dialog">
    <form class="modal-content">
    @csrf
<!--   <div class="modal-content"> -->
    <input type="hidden" id="id_cat-add" name="categoria_gasto_id">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Agregar nueva Sub-Categoría  | CATEGORÍA: 
         <label for="label" id="categoria_val"></label> </h4>
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
                    <div class="form-group @error('subcategoria') has-error @enderror">
                      <label for="subcategoria-add">SUBCATEGORÍA</label>
                      <input  type="text" class="form-control" id="subcategoria_aea" 
                          name="subcategoria" placeholder="Ingrese la nueva SUBCATEGORÍA" required>
                        @error('subcategoria')
                          <span class="help-block" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div> 
                  </div>   
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="codigo-add">Código</label>
                      <input id="codigo_new_subcat" type="text" class="form-control"
                          name="codigo"  readonly="">
                    </div>
                  </div>               
                </div>
              </div><!-- /.box-body -->    
             <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_add">      
              <div class="box-footer">
                <button type="submit" id="btn_add_subcat" class="btn btn-lg btn-success pull-left"><span class="fa fa-plus"></span>&nbsp; Añadir</button>

                <button type="" class="btn btn-lg btn-default pull-right" data-dismiss="modal">Cancelar</button>
                
              </div>
            </div><!-- /.box -->
          </div>  
        </div> 
      </div>
   <!-- </div> -->  </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
