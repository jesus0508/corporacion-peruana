<div class="modal fade" id="modal-edit-egreso-grifo" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('egresos.update',0)}}" method="post" class="modal-content">
     @csrf
      @method('PUT')
      <input type="hidden" id="id-edit" name="id">
      <input type="hidden" id="concepto_gasto_id-edit" name="concepto_gasto_id">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos del egreso</h4>        
      </div>
        <div class="modal-body">
          <div class="box box-succes">
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group @error('categoria') has-error @enderror">
                    <label for="categoria">Categoría Gasto</label>
                    <input type="text" class="form-control" id="categoria-edit" readonly="">          
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group @error('subcategoria') has-error @enderror">
                    <label for="subcategoria">SubCategoría Gasto</label>
                    <input type="text" class="form-control" id="subcategoria-edit" readonly="">
                  </div>          
                </div>  
              </div>      
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group @error('concepto') has-error @enderror">
                    <label for="concepto">Concepto gasto*</label>
                    <input type="text" id="concepto-edit" class="form-control" readonly="">  
                  </div>  
                </div>          
                <div class="col-md-4">
                  <div class="form-group @error('codigo_gasto') has-error @enderror">
                    <label for="codigo_gasto">Código gasto</label>
                    <input type="text" id="codigo-edit" class="form-control" readonly="">
                    
                  </div>          
                </div>        
              </div> <!-- end- row-->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group @error('monto_egreso') has-error @enderror">
                    <label for="monto_egreso">Monto gasto*</label>
                    <input id="monto_egreso-edit" type="text" class="form-control" name="monto_egreso" placeholder=" Ingrese el monto" required>
                    @error('monto_egreso')
                      <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                 </div>
                 <div class="col-md-6">
                  <div class="form-group @error('fecha_egreso') has-error @enderror">
                    <label for="fecha_egreso">Fecha egreso</label>
                    <input autocomplete="off" id="fecha_egreso-edit" type="text" class="tuiker 
                    form-control"  name="fecha_egreso" placeholder="Ingrese día" required="">
                    @error('fecha_gasto')
                      <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div> 
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group @error('grifo_id') has-error @enderror">
                    <label for="grifo_id">Grifo</label>
                    <select name="grifo_id" id="grifo_id" class="form-control">                      
                    </select>
                  </div>
                </div>    
              </div> <!-- end-row -->
            </div> 
          </div>
        </div><!-- /.box-body -->         
      <div class="modal-footer">
        <button type="submit" class="btn btn-success pull-left">Guardar cambios</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>