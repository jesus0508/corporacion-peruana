  <form action="{{route('vehiculo.store')}}" method="post">
    	 @csrf
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Datos Cisterna&nbsp;|&nbsp; <b> Asignar Cisterna a Transportista</b></h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <label for="nombre_transportista">Nombre de transportista</label>
            <select class="form-control" id="transportista" name="transportista_id">
              @isset($transportistas)
                    @foreach ( $transportistas as $transportista)
                      <option selected="true" value="{{$transportista->id}}">{{$transportista->nombre_transportista}}</option>
                    @endforeach
              @endisset

            </select>
            
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group @error('placa') has-error @enderror">
                <label for="placa">PLACA*</label>
                <input id="placa" type="text" class="form-control" name="placa" placeholder="Ingrese la placa de la cisterna" value="{{ old('placa') }}" pattern="[A-Za-z0-9]{3}[-]\d{3}" title="Formato: ABC-123" required>
                @error('placa')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

            </div>

            <div class="col-md-6">
              <div class="form-group @error('capacidad') has-error @enderror">
                <label for="capacidad">Capacidad - gls</label>
                <input id="capacidad" type="number" class="form-control" name="capacidad" placeholder="Ingrese la capacidad en galones" value="{{ old('capacidad') }}" min="0" max="999999" required>
                @error('capacidad')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              
            </div>
          </div> 
          <div class="form-group @error('detalle_compartimiento') has-error @enderror">
            <label for="detalle_compartimiento">Detalle compartimiento</label>
            <textarea class="form-control" style="resize: none;" id="detalle_compartimiento" name="detalle_compartimiento" placeholder="Detalle aquí las características del compartimiento ..." rows="3" >{{ old('detalle_compartimiento') }}</textarea>
            @error('detalle_compartimiento')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

        </div><!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn pull-right btn-success">
            <i class="fa fa-chain"> </i>
              Asignar 
          </button>
          
        </div><!-- /.box-footer -->        
      </div><!-- /.box -->
      	
    </div> <!-- /.col-md-6 -->
	</form>
  