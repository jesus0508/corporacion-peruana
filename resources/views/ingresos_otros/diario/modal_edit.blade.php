<div class="modal fade" id="modal-edit-ingresos" style="display: none;">
  <div class="modal-dialog modal-lg">
    <form action="{{route('ingresos_otros.update',0)}}" method="post" class="modal-content">
     @csrf
      @method('PUT')
      <input type="hidden" id="id-edit" name="id">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos  Ingreso</h4>        
      </div>
        <div class="modal-body">
          <div class="row">
  <!-- left column -->
    <div class="col-md-7">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Datos Principales </h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="categoria_ingreso">Categoría Ingreso</label>
                <select class="form-control" name="categoria_ingreso_id" id="categoria_ingreso_id">          
                </select>
              </div>
            </div>     
            <div class="col-md-4">
              <div class="form-group @error('monto_ingreso') has-error @enderror">
                <label for="monto_ingreso">Monto* </label>
                <input id="monto_ingreso" type="text" class="form-control" value="{{old('monto_ingreso')}}"
                        name="monto_ingreso" placeholder="Monto " required="" />
                @error('monto_ingreso')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>           
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="fecha_ingreso">Fecha de Ingreso </label>
                <input autocomplete="off" id="fecha_ingreso" type="text" class="tuiker form-control"
                        name="fecha_ingreso" placeholder="Fecha de Ingreso" required=""/>
              </div>               
            </div> 
            <div class="col-md-6">
              <div class="form-group">
                <label for="fecha_reporte">Fecha de Reporte </label>
                <input autocomplete="off" id="fecha_reporte" type="text" class="tuiker form-control"
                        name="fecha_reporte" placeholder="Fecha de Reporte" required=""/>
              </div>               
            </div>  
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group @error('detalle') has-error @enderror">
                <label for="detalle">Detalle</label>
                <input id="detalle" type="text" class="form-control" value="{{old('detalle')}}"
                        name="detalle" placeholder="Ingrese el detalle del ingreso" required />
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
  
    <div class="col-md-5">
      <!-- general form elements -->
      <div class="box">
        <div class="box-header with-border">
          <h2 class="box-title">Complementarios</h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group @error('linea_credito') has-error @enderror">
                <label for="codigo_operacion"> Codigo de Operación</label>
                <input id="codigo_operacion" type="text" step="any" class="form-control" value="{{old('codigo_operacion')}}"
                      name="codigo_operacion" placeholder="Código de operación ">
                @error('codigo_operacion')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group @error('banco') has-error @enderror">
                <div class="form-group">
                  <label for="banco">Banco</label>
                  <select class="form-control" id="banco" name="banco" placeholder="Seleccione el banco" >
                    <option value="BCP">BCP</option>
                    <option value="BBVA">BBVA</option>
                    <option value="SCOTIABANK">SCOTIABANK</option>
                  </select>
                </div>
                @error('banco')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
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
  </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>