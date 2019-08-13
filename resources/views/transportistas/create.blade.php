  <div class="row">
    <!-- left column -->
    <form action="{{route('transportista.store')}}" method="post">
    	 @csrf
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Datos Tranportista&nbsp;|&nbsp; <b> Registrar  Tranportista </b></h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="form-group @error('nombre_transportista') has-error @enderror">
            <label for="nombre_transportista">Nombre del transportista*</label>
            <input id="nombre_transportista" type="text" class="form-control" name="nombre_transportista" placeholder="Ingrese el nombre del transportista" value="{{ old('nombre_transportista') }}">
            @error('nombre_transportista')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group @error('ruc') has-error @enderror">
                <label for="ruc">RUC*</label>
                <input id="ruc" type="text" class="form-control" name="ruc" placeholder="Ingrese el RUC del transportista" value="{{ old('ruc') }}">
                @error('ruc')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

            </div>

            <div class="col-md-6">
              <div class="form-group @error('celular_transportista') has-error @enderror">
                <label for="celular_transportista">Celular Tranportista</label>
                <input id="celular_transportista" type="text" class="form-control" name="celular_transportista" placeholder="Ingrese el celular del transportista" value="{{ old('celular_transportista') }}">
                @error('celular_transportista')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              
            </div>
          </div>          


        </div><!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn  btn-success pull-right">
            <i class="fa fa-plus"> </i>&nbsp;
           Registrar TRANSPORTISTA
          </button>
        </div>
      </div><!-- /.box -->
    </div> <!-- /.col-md-6 -->
	</form>
    <!--/.col (left) -->
  	@include('vehiculos.create')
  
    <!--/.col (left) -->
  </div> <!-- /.row-top -->


