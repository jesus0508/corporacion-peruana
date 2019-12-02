<div class="modal fade" id="modal-edit-salidas" style="display: none;">
  <div class="modal-dialog modal-lg">
    <form action="{{route('salidas.update',0)}}" method="post" class="modal-content">
     @csrf
      @method('PUT')
      <input type="hidden" id="id-edit" name="id">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos del egreso</h4>        
      </div>
        <div class="modal-body">
          <div class="row">
          <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h2 class="box-title">Datos Principales </h2>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label for="categoria_ingreso">Categoría Egreso</label>
                        <select class="form-control" name="categoria_egreso_id" id="categoria_egreso_id" required="">
                               
                        </select>
                      </div>
                    </div>     
                    <div class="col-md-3">
                      <div class="form-group @error('monto_egreso') has-error @enderror">
                        <label for="monto_egreso">Monto* </label>
                        <input id="monto_egreso" type="text" class="form-control" value="{{old('monto_egreso')}}"
                                name="monto_egreso" placeholder="Monto " required>
                        @error('monto_egreso')
                        <span class="help-block" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>            
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fecha_egreso">Fecha de Egreso</label>
                        <input autocomplete="off" id="fecha_egreso" type="text" class="tuiker form-control"
                                name="fecha_egreso" placeholder="Fecha Egreso" required="">
                      </div>             
                    </div>  
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fecha_egreso">Fecha de Reporte </label>
                        <input autocomplete="off" id="fecha_reporte" type="text" class="tuiker form-control"
                                name="fecha_reporte" placeholder="Fecha Reporte" required="">
                      </div>             
                    </div>  
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group @error('detalle') has-error @enderror">
                        <label for="detalle">Detalle*</label>
                        <input id="detalle" type="text" class="form-control" value="{{old('detalle')}}"
                                name="detalle" placeholder="Ingrese el detalle del egreso" required>
                        @error('detalle')
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
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box">
                <div class="box-header with-border">
                  <h2 class="box-title">Datos complementarios</h2>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group @error('nro_comprobante') has-error @enderror">
                        <label for="nro_comprobante"> Número de comprobante</label>
                        <input id="nro_comprobante" type="text" step="any" class="form-control" value="{{old('nro_comprobante')}}"
                              name="nro_comprobante" placeholder="N° de comprobante ">
                        @error('nro_comprobante')
                        <span class="help-block" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group @error('codigo_operacion') has-error @enderror">
                        <label for="codigo_operacion"> Codigo de Operación</label>
                        <input id="codigo_operacion" type="text" step="any" class="form-control" value="{{old('codigo_operacion')}}"
                              name="codigo_operacion" placeholder="Ingrese el código de operación ">
                        @error('codigo_operacion')
                        <span class="help-block" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="nro_cheque">
                          N° Cheque
                        </label>
                        <input id="nro_cheque" type="text" step="any" class="form-control" value="{{old('nro_cheque')}}"
                              name="nro_cheque" placeholder="N° de cheque ">    
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="cuenta_id">
                           Banco - Número de Cuenta *
                        </label>
                        <select name="cuenta_id" id="cuenta_id" class="form-control">            
                        </select>     
                      </div>
                    </div> 
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-lg btn-success pull-left">
                        <span class="fa fa-save"></span> &nbsp;
                      Guardar cambios</button>                              
                    </div>
                    <div class="col-md-6">
                      <button type="" class="btn btn-lg btn-default pull-right" data-dismiss="modal">Cancelar</button>
                    </div>                    
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
        </div> <!-- /.row-top -->    
      </div> <!-- end-modal-body -->
<!--       <div class="modal-footer">
        <button type="submit" class="btn btn-lg btn-success pull-left">
          <span class="fa fa-save"></span> &nbsp;

        Guardar cambios</button>
        <button type="" class="btn btn-lg btn-default" data-dismiss="modal">Cancelar</button>
      </div> -->
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>