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
            <div class="col-md-6">
              <div class="form-group @error('fecha') has-error @enderror">
                <label for="fecha">Fecha* </label>
                <input autocomplete="off" id="fecha" type="text" class="tuiker form-control" name="fecha" placeholder="Fecha" required="" pattern="">
                @error('fecha')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div> 
            </div>       
            <div class="col-md-6">
              <div class="form-group @error('monto') has-error @enderror">
                <label for="monto">Monto* </label>
                <input id="monto" type="text" class="form-control" value="{{old('monto')}}"
                        name="monto" placeholder="Monto " required  pattern="(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{2}))?)"
                          title="2 decimales">
                @error('monto')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>             
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="detalle">Detalles Comprobación*</label>
                <textarea name="detalle" id="detalle" cols="30" rows="2"
                 placeholder="Ingrese los detalles" class="form-control"></textarea>
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
          <h2 class="box-title">Datos Comprobación </h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group @error('linea_credito') has-error @enderror">
                <label for="codigo_operacion">Monto Total Ingresos Efectivo
                </label>
                <input id ="total_ingresos" style="color:blue; font-weight: bold;" type="text" class="form-control" readonly="" value="0.00">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('linea_credito') has-error @enderror">
                <label for="codigo_operacion">Monto Total Egresos Depósitos
                </label>
                <input id ="total_egresos" style="color:red; font-weight: bold;" type="text" class="form-control" readonly="" value="0.00">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('linea_credito') has-error @enderror">
                <label for="codigo_operacion">Monto a Comprobar
                </label>
                <input id ="monto_comprobacion" style="color:black; font-weight: bold;" type="text" class="form-control" readonly="" value="0.00" onchange='evaluarBtn()'>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('linea_credito') has-error @enderror">
                <label for="codigo_operacion">Resta Comprobar</label>
                <input style="color: black; font-weight: bold;" id="restante_comprobacion" type="text" class="form-control" readonly="" value="0.00">
              </div>               
            </div>
          </div>        
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

    <div class="col-md-12">
      <div class="form-group pull-right" >
        <button type="submit" id="btn_register" class="btn btn-success">
          <i class="fa fa-save"> </i>
            Registrar  Comprobación
        </button>
      </div>
    </div>
</div> <!-- /.row-top -->


