<div class="row">
  <!-- left column -->
  
    @csrf
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Registro Transporte</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-2  ">
              <div class="form-group @error('tipo') has-error @enderror">
                <label for="tipo">Tipo</label>
                <select id="tipo" class="form-control" name="tipo">
                  
                  <option value="2">Buses</option>
                  
                  
              

             </select>
             @error('tipo')
             <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
             </span>
              @enderror
            </div>
            </div>

          <div class="col-md-2">
                <div class="form-group @error('fecha_reporte') has-error @enderror">
                  <label for="fecha_reporte">Fecha para reporte</label>
                  <input autocomplete="off" id="fecha_reporte" type="text" class="tuiker form-control"
                  name="fecha_reporte" placeholder="Ingrese la fecha de reporte">
                  @error('fecha_reporte')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>          
            <div class="col-md-2">
              <div class="form-group @error('placa') has-error @enderror">
                <label for="placa">Placa</label>
                <input id="placa" type="tel" class="form-control" value="{{old("placa")}}" required
                        name="placa" placeholder="Ingrese el numero de placa" required>
                @error('placa')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div>

            <div class="col-md-2">
                <div class="form-group @error('fecha_ingreso') has-error @enderror">
                  <label for="fecha_ingreso">Fecha de ingreso</label>
                  <input autocomplete="off" id="fecha_ingreso" type="text" class="tuiker form-control"
                  name="fecha_ingreso" placeholder="Ingrese la fecha de ingreso">
                  @error('fecha_ingreso')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

            <div class="col-md-2">
              <div class="form-group @error('monto') has-error @enderror">
                <label for="monto">Monto</label>
                <input id="monto" type="number" class="form-control" value="{{old("monto")}}" required
                        name="monto" placeholder="Ingrese el numero de monto" required>
                @error('monto')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div>
            
            <div class="col-md-2">
                <div class="form-group">
                      <button type="submit" class="btn btn-lg btn-success">
                      <i class="fa fa-save"> </i>
                       Registrar Ingreso
                      </button>
                </div>
            </div>

          </div>
          
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (left) -->
  
    

    
  
</div> <!-- /.row-top -->
