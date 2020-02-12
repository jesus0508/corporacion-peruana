<div class="row">
  <div class="col-md-12">
    <h2></h2>
    <!-- general form elements -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">CONFIRMAR DATOS PAGO</h2>
      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group @error('fecha_egreso') has-error @enderror">
              <label for="fecha_egreso">Fecha egreso*</label>
              <input autocomplete="off" id="fecha_egreso" type="text" class="form-control" 
               value="{{$pago->fecha_egreso}}" name="fecha_egreso"
               placeholder="Ingrese fecha de egreso" required>
              @error('fecha_egreso')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group @error('fecha_reporte') has-error @enderror">
              <label for="fecha_reporte">Fecha Reporte*</label>
              <input autocomplete="off" id="fecha_reporte"   type="text"  class="form-control" value="{{$pago->fecha_reporte}}" step="any" min="0" 
                    name="fecha_reporte" placeholder="Ingrese fecha reporte">
              @error('fecha_reporte')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group @error('monto_pago') has-error @enderror">
              <label for="monto_pago">Monto a pagar*</label>
              <input id="monto_pago"   type="number" class="form-control" value="{{$pago->monto_pago}}" step="any" min="0" 
                    name="monto_egreso" placeholder="Ingrese monto pago" required="">
              @error('monto_pago')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
        </div> 
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="categoria">Categoría Egreso* </label>
              <select name="categoria_egreso_id"  class="form-control" id="" readonly="">
                <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
              </select>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group @error('detalle') has-error @enderror">
              <label for="detalle">Detalle*</label>
              <input id="detalle" type="text" class="form-control" 
                value="{{$pago->detalle}}" name="detalle" 
                placeholder="Ingrese la descripción" required="">
              @error('detalle')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>                  
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="pull-right">
              <button class="btn btn-lg btn-success">CONFIRMAR PAGO</button>
            </div>
          </div>
        </div>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!--/.col (right) -->
</div> {{-- end.row --}}