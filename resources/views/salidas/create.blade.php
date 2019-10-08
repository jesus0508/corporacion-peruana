<div class="row">
  <!-- left column -->
    <div class="col-md-9">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Datos Principales </h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="categoria_ingreso">Categoría Egreso</label>
                <select class="form-control" name="categoria_egreso_id" id="categoria_egreso_id" required="">
                  @foreach( $categorias as $cat )
                    <option value="{{$cat->id}}">{{$cat->categoria}}</option>
                  @endforeach           
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="fecha_egreso">Fecha de Egreso* </label>
                <input autocomplete="off" id="fecha_egreso" type="text" class="tuiker form-control"
                        name="fecha_egreso" placeholder="Fecha de Egreso" required="">
              </div>               
            </div>       
            <div class="col-md-2">
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
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group @error('detalle') has-error @enderror">
                <label for="detalle">Detalle</label>
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
  
    <div class="col-md-3">
      <!-- general form elements -->
      <div class="box">
        <div class="box-header with-border">
          <h2 class="box-title">Datos complementarios</h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
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
            <div class="col-md-12">
              <div class="form-group">
                <label for="razon_social">
                   Banco - Número de Cuenta *
                </label>
                <select name="cuenta_id" id="cuenta_id" class="form-control">
                  @foreach($cuentas as $cuenta)
                  <option value="{{$cuenta->id}}">{{$cuenta->nro_cuenta}}</option>
                  @endforeach             
                </select>     
              </div>
            </div> 
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (right) -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    <div class="col-md-12">
      <div class="form-group">
        <button type="submit" id="btn_register" class="btn btn-lg btn-success">
          <i class="fa fa-save"> </i>
          Registrar nuevo EGRESO
        </button>
      </div>
    </div>
</div> <!-- /.row-top -->


