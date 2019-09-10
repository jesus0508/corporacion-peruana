<div class="row">
  <form class="" action="{{route('pago_proveedors.store')}}" method="post">
    @csrf
          <!-- left column -->
          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales Operación</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
               <div class="form-group @error('fecha_operacion') has-error @enderror">
                  <label for="fecha_operacion">Fecha factura</label>
                  <input autocomplete="off" id="fecha_factura" type="text" class="tuiker form-control" value="{{ old('fecha_operacion') }}"
                  name="fecha_operacion" placeholder="Ingrese la fecha de la operación"
                  required="" >
                  @error('fecha_operacion')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group @error('codigo_operacion') has-error @enderror">
                    <label for="codigo_operacion">Codigo de operacion</label>
                    <input id="codigo_operacion" type="text" class="form-control"
                            name="codigo_operacion" value="{{ old('codigo_operacion') }}" placeholder="Ingrese el codigo de la operacion" required>
                    @error('codigo_operacion')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales Operación</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="monto_operacion">Monto</label>
                  <input id="monto_operacion" type="text" class="form-control"
                          name="monto_operacion" placeholder="Ingrese el monto de la operacion" value="{{ old('monto_operacion') }}"
                          pattern="(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{2}))?)" title="Formato: Use 2 decimales" 
                          required>
                </div>
                <div class="form-group">
                  <label for="banco">Banco</label>
                  <select class="form-control" id="banco" value="{{ old('banco') }}" name="banco" placeholder="Seleccione el banco">
                    <option value="BCP">BCP</option>
                    <option value="BBVA">BBVA</option>
                    <option value="SCOTIABANK">SCOTIABANK</option>
                  </select>
                </div>
                <input type="hidden" name="proveedor_id" value="{{$proveedor->id}}">
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
      <div class="col-md-6">
        <div>
         <!--  <b>PROVEEDOR: </b> -->
          <h3> 
            &nbsp;<span class="label label-primary">{{$proveedor->razon_social}}</span>
          </h3>
        </div>        
      </div>
      <div class="col-md-6">

        @if( $pedidos->count() > 0)
          <div class="form-group pull-right">
                <button type="submit" class="btn btn-lg btn-success">
                  <i class="fa fa-money"> </i>
                  Realizar PAGO en BLOQUE
                </button>
          </div>
        @else
          <div class="form-group pull-right">
                <button type="submit" class="btn btn-lg btn-success" disabled="">
                  <i class="fa fa-money"> </i>
                  Realizar PAGO en BLOQUE
                </button>
          </div>
        @endif
      </div>
  </form>
</div> <!-- /.row-top -->
