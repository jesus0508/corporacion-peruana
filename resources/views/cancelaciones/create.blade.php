<div class="row">
  <!-- left column -->
  <form class="" action="{{route('cancelacion.store')}}" method="post">
    @csrf
    <input type="hidden" id="ingreso_grifo_id" name="ingreso_grifo_id">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">FACT FAVOR</h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group @error('fecha') has-error @enderror">
                  <label for="fecha">Fecha Ingreso</label>
                  <input autocomplete="off" id="fecha" type="text" class="tuiker form-control"                  placeholder="Ingrese la fecha ingresoG "
                  required="" >
                  @error('fecha')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group @error('grifo_id') has-error @enderror">
                <label for="grifo_id">Grifo</label>
                <select class="form-control" id="grifo_id"   name="grifo_id" required>
                    @foreach ( $grifos as $grifo )
                      <option value="{{$grifo->id}}">{{$grifo->razon_social}}</option>
                    @endforeach
                </select>             

              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="nro_serie">Número(s) de serie</label>
                <input id="nro_serie" type="text" class="form-control" 
                        readonly="">
              </div>
            </div>
<!--             <div class="col-md-3">
              <div class="form-group">
                <label for="facturacion">Número(s) factura</label>
                <input id="facturacion" type="text" class="form-control" 
                        readonly="">
              </div>
            </div> -->
          </div>                    

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="precio_galon">Precio Galon</label>
                <input id="precio_galon" type="text" class="form-control" 
                        readonly="">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="galones">Galones</label>
                <input id="galones" type="text" class="form-control" 
                        readonly="">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="monto_ingreso">Monto resultante </label>
                <input id="monto_ingreso" type="text" class="form-control" 
                       readonly="">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="saldo">Saldo</label>
                <input id="saldo" type="text" class="form-control" 
                        readonly="">
              </div>
            </div>                                    
          </div>
          <div class="row">            
            <div class="col-md-4">
              <div class="form-group @error('monto') has-error @enderror">
                <label for="monto">Monto Depósito</label>
                <input id="monto" type="text" class="form-control" value="{{old('monto')}}"
                        name="monto" placeholder="Ingrese  monto" required>
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
                <input id="nro_operacion" type="text" class="form-control" value="{{old('nro_operacion')}}"
                        name="nro_operacion" placeholder="Ingrese el N° de operación" required>
                @error('nro_operacion')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group @error('fecha') has-error @enderror">
                  <label for="fecha">Fecha Depósito</label>
                  <input autocomplete="off" id="fecha_deposito" type="text" class="tuiker form-control" value="{{ old('fecha') }}"
                  name="fecha" placeholder="Ingrese la fecha "
                  required="" >
                  @error('fecha')
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

    <div class="col-md-12">
      <div class="form-group pull-right">
        <button type="submit" class="btn btn-lg btn-success">
          <i class="fa fa-save"> </i>
          Registrar nuevo depósito
        </button>
      </div>
    </div>
  </form>
</div> <!-- /.row-top -->


