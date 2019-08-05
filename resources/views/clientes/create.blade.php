<div class="row">
  <!-- left column -->
  <form class="" action="{{route('clientes.store')}}" method="post">
    @csrf
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Registro Cliente</h3>
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
            <label for="razon_social">Razón Social</label>
            <input id="razon_social" type="text" class="form-control" 
                    name="razon_social" placeholder="Ingrese la Razon Social">
            @error('razon_social')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group @error('telefono') has-error @enderror">
            <label for="telefono">Teléfono</label>
            <input id="telefono" type="tel" class="form-control"
                    name="telefono" placeholder="Ingrese el numero de telefono">
            @error('telefono')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (left) -->
  
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box">
        <div class="box-header with-border">
          <h2 class="box-title">Datos complementarios</h2>
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
            <label for="direccion">Dirección</label>
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
    </div><!--/.col (right) -->

    <div class="col-md-12">
      <div class="form-group">
        <button type="submit" class="btn btn-lg btn-success">
          <i class="fa fa-save"> </i>
          Registrar nuevo cliente
        </button>
      </div>
    </div>
  </form>
</div> <!-- /.row-top -->


