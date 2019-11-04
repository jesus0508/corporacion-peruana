<div class="row">
  <!-- left column -->
  
    @csrf
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Datos del Transporte</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-4  ">
              <div class="form-group @error('tipo') has-error @enderror">
                <label for="tipo">Tipo</label>
                <select id="tipo" class="form-control" name="tipo">
                  
                  
                  <option value="1">Autos</option>
                  <option value="2">Buses</option>
                  <option value="3">Cisternas</option>
                  <option value="4">Administrativo</option>
                  
              

             </select>
             @error('tipo')
             <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
             </span>
              @enderror
            </div>
            </div>

          <div class="col-md-4">
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
            <div class="col-md-4">
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
  
    

    
  <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Datos complementarios</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
                     
            
            

            <div class="col-md-4  ">
              <div class="form-group @error('tipo_comprobante') has-error @enderror">
                <label for="tipo_comprobante">Comprobante</label>
                <select id="tipo_comprobante" class="form-control" name="tipo_comprobante">
                  
                  
                  <option value="1">Boleta</option>
                  <option value="2">Factura</option>
                  <option value="3">ticket</option>
                  <option value="4">comprbante interno</option>
                  <option value="5">proforma simple</option>
              

             </select>
             @error('tipo_comprobante')
             <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
             </span>
              @enderror
            </div>
            </div>

            <div class="col-md-4">
                <div class="form-group @error('fecha_egreso') has-error @enderror">
                  <label for="fecha_egreso">Fecha de egreso</label>
                  <input autocomplete="off" id="fecha_egreso" type="text" class="tuiker form-control"
                  name="fecha_egreso" placeholder="Ingrese la fecha de egreso">
                  @error('fecha_egreso')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

            <div class="col-md-4">
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

             <div class="col-md-4">
              <div class="form-group @error('num_comprobante') has-error @enderror">
                <label for="num_comprobante">Numero de comprobante</label>
                <input id="num_comprobante" type="tel" class="form-control" value="{{old("num_comprobante")}}" required
                        name="num_comprobante" placeholder="Ingrese el numero de num_comprobante" required>
                @error('num_comprobante')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div>

            <div class="col-md-8">
              <div class="form-group @error('descripcion') has-error @enderror">
                <label for="descripcion">Descripcion</label>
                <input id="descripcion" type="tel" class="form-control" value="{{old("descripcion")}}" required
                        name="descripcion" placeholder="Ingrese el numero de descripcion" required>
                @error('descripcion')
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
  
    

    
</div> <!-- /.row-top -->
