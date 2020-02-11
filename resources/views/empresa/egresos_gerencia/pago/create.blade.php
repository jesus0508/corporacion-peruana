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
          <div class="col-md-6">
            <div class="form-group @error('fecha_egreso') has-error @enderror">
              <label for="fecha_egreso">Fecha egreso*</label>
              <input id="fecha_egreso" type="text" class="form-control" 
               value="{{$pago->fecha_egreso}}" name="fecha_egreso"
               placeholder="Ingrese fecha de egreso" required>
              @error('fecha_egreso')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group @error('monto_pago') has-error @enderror">
              <label for="monto_pago">Monto a pagar</label>
              <input id="monto_pago"   type="number" class="form-control" value="{{$pago->monto_pago}}" step="any" min="0" 
                    name="monto_pago" placeholder="Ingrese monto pago">
              @error('monto_pago')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
        </div> 
        <div class="row">
          <div class="col-md-12">
            <div class="form-group @error('descripcion') has-error @enderror">
              <label for="descripcion">Descripción</label>
              <input id="descripcion" type="text" class="form-control" 
              value="{{$pago->descripcion}}"    name="descripcion"  placeholder="Ingrese la descripción">
              @error('descripcion')
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