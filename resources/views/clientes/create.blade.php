<form action="{{route('clientes.store')}}" method="post">
  @csrf
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Datos principales</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="form-group @error('ruc') has-error @enderror">
            <label for="ruc">RUC</label>
            <input id="ruc" type="text" class="form-control" 
                    name="ruc" placeholder="Ingrese su RUC">
            @error('ruc')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group @error('razon_social') has-error @enderror">
            <label for="razon_social">Razon Social</label>
            <input id="razon_social" type="text" class="form-control" 
                    name="razon_social" placeholder="Ingrese la Razon Social">
            @error('razon_social')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
    <!--/.col (left) -->
  
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Datos secundarios</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="form-group @error('tipo') has-error @enderror">
            <label for="tipo">Tipo</label>
            <select id="tipo" class="form-control" name="tipo">
              <option value="1">Grifo</option>
              <option value="2">Normal</option>
            </select>
            @error('tipo')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group @error('dirrecion') has-error @enderror">
            <label for="direccion">Direccion</label>
            <input id="direccion" type="text" class="form-control" 
                    name="direccion" placeholder="Ingrese la direccion">
            @error('direccion')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div> <!-- /.row-top -->
  <div class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-lg btn-primary">
        <i class="fa fa-plus-square-o"> </i>
        Registrar nuevo cliente
      </button>
    </div>
  </div> <!-- /.row-bottom -->
</form>
