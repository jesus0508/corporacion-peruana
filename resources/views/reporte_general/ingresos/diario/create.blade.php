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
                <label for="categoria_ingreso">Categoría Ingreso</label>
                <select class="form-control" name="categoria_ingreso_id" id="categoria_ingreso_id">
                  @foreach( $categorias as $cat )
                    <option value="{{$cat->id}}">{{$cat->categoria}}</option>
                  @endforeach           
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="fecha_ingreso">Fecha de Ingreso* </label>
                <input autocomplete="off" id="fecha_ingreso" type="text" class="tuiker form-control"
                        name="fecha_ingreso" placeholder="Fecha de Ingreso" required=""/>
              </div>               
            </div>       
            <div class="col-md-2">
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
  
    <div class="col-md-3">
      <!-- general form elements -->
      <div class="box">
        <div class="box-header with-border">
          <h2 class="box-title">Datos complementarios</h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group @error('linea_credito') has-error @enderror">
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
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (right) -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    <div class="col-md-12">
      <div class="form-group">
        <button type="submit" id="btn_register" class="btn btn-lg btn-success">
          <i class="fa fa-save"> </i>
          Registrar nuevo INGRESO
        </button>
      </div>
    </div>
</div> <!-- /.row-top -->


