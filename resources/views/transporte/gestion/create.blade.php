<div class="row">
  <!-- left column -->
  <form action="{{route('transporte.store')}}" method="POST">
    @csrf
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Registro Transporte</h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="tipo">Tipo</label>
                <select id="tipo" class="form-control" name="tipo" required="">
                  <option value="1">Autos</option>
                  <option value="2">Buses</option>
                  <option value="3">Cisternas</option>
                  <option value="4">Administrativo</option>
              <!--     <option value="4">Unidades</option>    -->                           
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group @error('placa') has-error @enderror">
                <label for="placa">Placa</label>
                <input id="placa" type="text" class="form-control" 
                value="{{old('placa')}}"   pattern="[A-Za-z0-9]{3}[-]\d{3}" 
                title="Formato: ABC-123"     
                 name="placa"
                  placeholder="Ejemplo: ABC-123" required>
                @error('placa')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group @error('chofer') has-error @enderror">
                <label for="chofer">Chofer</label>
                <input id="chofer" type="text" class="form-control" value="{{old('chofer')}}"
                        name="chofer" placeholder="Ingrese el combre completo del conductor" >
                @error('chofer')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                      <button type="submit" class="btn btn-lg btn-success">
                      <i class="fa fa-save"> </i>
                       Registrar Transporte
                      </button>
                </div>
            </div>
          </div>          
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (left) -->    
  </form>
</div> <!-- /.row-top -->


