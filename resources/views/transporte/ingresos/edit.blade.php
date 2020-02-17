<div class="modal fade" id="modal-edit-ingreso-transporte" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('ingreso_transporte.update',0)}}" method="post" class="modal-content">
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
                <div class="form-group @error('fecha_ingreso') has-error @enderror">
                  <label for="fecha_ingreso">Fecha de ingreso</label>
                  <input autocomplete="off" id="fecha_ingreso-edit" type="text" class="tuiker form-control"
                  name="fecha_ingreso" placeholder="Fecha de ingreso">
                  @error('fecha_ingreso')
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
                  <div class="form-group @error('monto_ingreso') has-error @enderror">
                    <label for="monto_ingreso-edit">Monto Ingreso</label>
                    <input id="monto_ingreso-edit" type="number" class="form-control"
                     value="{{old("monto_ingreso")}}" name="monto_ingreso"
                      placeholder="Monto Ingreso">
                    @error('monto_ingreso')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div> {{-- end.row- --}}
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
