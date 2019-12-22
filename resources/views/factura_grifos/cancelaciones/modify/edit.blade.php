<div class="modal fade" id="modal-edit-cancelacion" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('cancelacion.update',0)}}" method="POST" class="modal-content">
     @csrf
      @method('PUT')
      <input type="hidden" id="id-edit" name="id">
      <input type="hidden" id="facturacion_grifo_id-edit" name="facturacion_grifo_id">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos Cancelación</h4>        
      </div>
        <div class="modal-body">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">  
            <div class="col-md-4">
              <div class="form-group @error('fecha') has-error @enderror">
                <label for="fecha">Fecha Operación</label>
                <input autocomplete="off" id="fecha-edit" type="text" 
                  class="tuiker form-control" placeholder="Fecha depósito" 
                    name="fecha" >
                  @error('fecha')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>
            </div> 
            <div class="col-md-4">
              <div class="form-group @error('monto') has-error @enderror">
                <label for="monto">Monto Operación</label>
                <input id="monto-edit" type="number" step="any" min="0" 
                  class="form-control" placeholder="Monto depósito" 
                    name="monto" >
                  @error('monto')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>
            </div> 
            <div class="col-md-4">
              <div class="form-group @error('nro_operacion') has-error @enderror">
                <label for="nro_operacion">Número de Operación</label>
                <input id="nro_operacion-edit" type="text"  
                  class="form-control" placeholder="Número operación" 
                    name="nro_operacion" >
                  @error('nro_operacion')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>
            </div>              
          </div>        
        </div> <!-- /.end-box-body --> 
          <div class="box-footer row">
            <div class="pull-right">
              <div class="col-md-2">
                <div class="form-group">                  
                  <button type="" class="btn btn-default" data-dismiss="modal">
                  Cancelar</button>
                </div>                
              </div> 
            </div>
            <div class="pull-left">
              <div class="col-md-2">
                <div class="form-group">                  
                  <button  type="submit" id="register-edit" class="btn btn-success " >
                    <i class="fa fa-save"> </i>&nbsp;
                    Guardar                  
                  </button>
                </div>                
              </div> 
            </div> 
          </div>   
        </div> {{-- box-success --}}
      </div> {{-- modal-body --}}
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>