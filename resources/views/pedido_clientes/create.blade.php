<form action="{{route('pedido_clientes.store')}}" method="post">
  @csrf
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Formulario</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="form-group @error('nro_pedido') has-error @enderror">
            <label for="nro_pedido">Número de Pedido</label>
            <input id="nro_pedido" type="text" class="form-control" 
                    name="nro_pedido" placeholder="Ingrese el numero de pedido">
            @error('nro_pedido')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group @error('scop') has-error @enderror">
            <label for="scop">SCOP</label>
            <input id="scop" type="text" class="form-control"
                    name="scop" placeholder="Ingrese el SCOP">
            @error('scop')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group @error('grifo') has-error @enderror">
            <label for="grifo">Grifo</label>
            <input id="grifo" type="text" class="form-control" 
                    name="grifo" placeholder="Ingrese el nombre del Grifo">
            @error('grifo')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group @error('galones') has-error @enderror">
            <label for="galones">Galones</label>
            <input id="galones" type="number" class="form-control" 
                    name="galones" placeholder="Ingrese el numero galones">
            @error('grifo')
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
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="form-group @error('planta') has-error @enderror">
            <label for="planta">Planta</label>
            <select class="form-control" name="planta" id="planta">
                <option>Pampilla</option>
                <option>Callao</option>
                <option>PBF</option>
                <option>Conchan</option>
            </select>
            @error('planta')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group @error('horario_descarga') has-error @enderror">
            <label for="horario_descarga">Horario para descarga</label>
            <input id="horario_descarga" type="text" class="form-control"
                    name="horario_descarga" placeholder="Ingrese el horario para descarga">
            @error('horario_descarga')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group @error('observacion') has-error @enderror">
            <label for="observacion">Observacion</label>
            <textarea id="observacion" type="text" class="form-control"
                    name="observacion" placeholder="Ingrese alguna observacion imporante"></textarea>
            @error('observacion')
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
        Registrar pedido
      </button>
    </div>
  </div> <!-- /.row-bottom -->
</form>
