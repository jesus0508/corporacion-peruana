<div class="modal fade" id="modal-add-concepto" style="display: none;">
  <div class="modal-dialog">
    <form class="modal-content" action="{{route('concepto_gastos.store')}}" method="post">
    @csrf
    <input type="hidden" id="id_subcat-add" name="sub_categoria_gasto_id">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Agregar Nuevo GASTO  | Sub CATEGORÍA: 
         <label for="label" id="subcategoria_val"></label> </h4>

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
                    <div class="form-group @error('concepto_gasto') has-error @enderror">
                      <label for="concepto_gasto-add">Gasto</label>
                      <input  type="text" class="form-control"
                          name="concepto" placeholder="Ingrese el nuevo gasto" required>
                        @error('concepto_gasto')
                          <span class="help-block" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div> 
                  </div>   
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="codigo-add">Código</label>
                      <input id="codigo_new_concepto" type="text" class="form-control"
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