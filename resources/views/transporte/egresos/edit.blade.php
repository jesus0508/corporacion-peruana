<div class="modal fade" id="modal-edit-egreso-transporte" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('egreso_transporte.update',0)}}" method="post" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Editar datos Ingreso Transporte (Buses)</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h2 class="box-title">Ingreso Bus</h2>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group @error('tipo') has-error @enderror">
                    <label for="tipo">Tipo*</label>
                    <select id="tipo-edit" class="form-control" disabled="">                        
                      <option value="1">Autos</option>
                      <option value="2">Buses</option>
                      <option value="3">Cisternas</option>
                      <option value="4">Administrativo</option>
                    </select>
                   @error('tipo')
                   <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                  </div>                  
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="tipo_comprobante">Comprobante*</label>
                    <select id="tipo_comprobante-edit" class="form-control" 
                      value="{{old('tipo_comprobante')}}"  name="tipo_comprobante" required="">  
                      <option value="1">Boleta</option>
                      <option value="2">Factura</option>
                      <option value="3">Ticket</option>
                      <option value="4">Comprobante interno</option>
                      <option value="5">Proforma simple</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group @error('fecha_reporte') has-error @enderror">
                    <label for="fecha_reporte">Fecha reporte</label>
                    <input autocomplete="off" id="fecha_reporte-edit" type="text" class="form-control"
                    name="fecha_reporte" placeholder="Fecha de reporte">
                    @error('fecha_reporte')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group @error('fecha_egreso') has-error @enderror">
                  <label for="fecha_egreso">Fecha de egreso</label>
                  <input autocomplete="off" id="fecha_egreso-edit" type="text" class="tuiker form-control"
                  name="fecha_egreso" placeholder="Fecha de egreso">
                  @error('fecha_egreso')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                </div>
              </div> {{-- end.row- --}}
              <div class="row">
                <div class="col-md-6">
              <div class="form-group @error('placa') has-error @enderror">
                <label for="placa">Placa</label>
                   <select id="placa-edit" class="form-control"
                  name="transporte_id" required="">   
                  @foreach($transportes as $transporte)
                    <option value="{{$transporte->id}}">{{$transporte->placa}}</option>
                  @endforeach                                
                </select>
              </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group @error('monto_egreso') has-error @enderror">
                    <label for="monto_egreso-edit">Monto Ingreso</label>
                    <input id="monto_egreso-edit" type="number" class="form-control"
                     value="{{old("monto_egreso")}}" name="monto_egreso"
                      placeholder="Monto Ingreso">
                    @error('monto_egreso')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div> {{-- end.row- --}}
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group @error('nro_comprobante') has-error @enderror">
                    <label for="nro_comprobante">Numero de comprobante*</label>
                    <input id="nro_comprobante-edit" type="text" class="form-control" value="{{old('nro_comprobante')}}" required
                            name="nro_comprobante" placeholder="Número de comprobante" required>
                    @error('nro_comprobante')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group @error('descripcion') has-error @enderror">
                    <label for="descripcion">Descripción*</label>
                    <input id="descripcion-edit" type="text" class="form-control"
                         value="{{old('descripcion')}}" 
                            name="descripcion" placeholder="Ingrese la   descripcion" required>
                    @error('descripcion')
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
        <input id="id-edit" type="hidden" name="id">
      </div> {{-- modal.body --}}
      <div class="modal-footer">
        <div class="row">
          <div class="col-md-2"> 
            <button type="submit" class="btn btn-success">Guardar cambios</button>            
          </div>
          <div class="col-md-10">
          </div>
          <div class="col-md-2 pull-right">
            <button type="" class="btn btn-default " data-dismiss="modal">Cancelar</button>   
          </div>
        </div>
      </div>  
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
