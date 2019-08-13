<form action="{{route('planta.store')}}" method="post">
  @csrf
  <div class="col-md-6">
      <!-- general form elements -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Datos Planta&nbsp;|&nbsp; <b> Asignar Planta a Proveedor</b></h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
             <div class="form-group">
              <label for="proveedor">Proveedor*</label>
              <select class="form-control" id="proveedor" name="proveedor_id">
                @isset($proveedores)
                    @foreach ( $proveedores as $proveedor)
                      <option selected="true" value="{{$proveedor->id}}">{{$proveedor->razon_social}}</option>
                    @endforeach
                @endisset
              </select>            
            </div>
          </div>
          
        </div>
        <div class="row">

          <div class="col-md-6">
            <div class="form-group @error('planta') has-error @enderror">
              <label for="planta">Nombre de la planta*</label>
              <input id="planta" type="text" class="form-control" name="planta" placeholder="Ingrese la Razon Social"  value="{{ old('planta') }}" required>
              @error('planta')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group @error('celular_planta') has-error @enderror">
              <label for="celular_planta">Celular de la planta</label>
              <input id="celular_planta" type="number" class="form-control" name="celular_planta" placeholder="Ingrese el celular de la planta" value="{{ old('celular_planta') }}" min="900000000" max="999999999" title="Formato: 9 dígitos">
              @error('celular_planta')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div> 
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group @error('direccion_planta') has-error @enderror">
              <label for="direccion_planta">Dirección de la planta</label>
              <input id="direccion_planta" type="text" class="form-control" name="direccion_planta" placeholder="Ingrese la Dirección de la planta" value="{{ old('direccion_planta') }}" >
              @error('direccion_planta')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>            
          </div>
        </div>

      </div><!-- /.box-body -->
      <div class="box-footer">
          <button type="submit" class="btn pull-right btn-success">
            <i class="fa fa-chain"> </i>
              Asignar 
          </button>
          
      </div><!-- /.box-footer -->
    </div><!-- /.box -->
  </div>
</form>  
    <!--/.col (right) -->


