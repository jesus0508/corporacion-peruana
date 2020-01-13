<div class="modal fade" id="modal-edit-facturacion" style="display: none;">
  <div class="modal-dialog modal-lg">
    <form action="{{route('factura_grifos.update',0)}}" method="post" class="modal-content">
     @csrf
      @method('PUT')
      <input type="hidden" id="id-edit" name="id">
      <input type="hidden" id="grifo_id-edit" name="grifo_id">
      <input type="hidden" id="serie_id-edit" name="serie_id">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos  Facturación</h4>        
      </div>
        <div class="modal-body">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row" id="">
            <div class="col-md-3">
              <div class="form-group @error('fecha') has-error @enderror">
                  <label for="fecha">Fecha Facturación*</label>
                  <input autocomplete="off" id="fecha_facturacion-edit" type="text" class="tuiker form-control" placeholder="Fecha facturación" 
                  name="fecha_facturacion"   readonly="">
                  @error('fecha')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="grifo_id">Grifo</label>
                <input type="text" id="grifo_name-edit" readonly=""
                class="form-control">
         
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="nro_serie">Número de serie</label>
                <input id="nro_serie-edit" type="text" class="form-control" 
                        readonly="">
              </div>
            </div>
          </div>                  
            <div class="row" id="input_user-edit">
              <div class="col-md-2">
                <div class="form-group @error('venta_factura') has-error @enderror">
                  <label for="venta_factura">Venta Factura </label>
                  <input id="venta_factura-edit" type="number" step="any" min="0" class="form-control" 
                          placeholder="Venta factura"  name="venta_factura" >
                  @error('venta_factura')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror 
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group @error('venta_boleta') has-error @enderror">
                  <label for="venta_boleta">Venta Boleta</label>
                  <input id="venta_boleta-edit" type="number" step="any" min="0" class="form-control" 
                          placeholder="Venta boleta" name="venta_boleta" >
                  @error('venta_boleta')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror 
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="total_galones">Total galones </label>
                  <input id="total_galones-edit" type="text" class="form-control" 
                        readonly="" >
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group @error('precio_venta') has-error @enderror">
                  <label for="precio_galon">Precio Galón*</label>
                  <input id="precio_venta-edit" name="precio_venta" type="number"
                    step="any" min="1" class="form-control" placeholder="Precio galón" 
                    required="" >
                  @error('precio_venta')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror 
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="monto_total">Monto Total</label>
                  <input id="monto_total-edit" type="text" class="form-control" 
                         readonly="" >
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