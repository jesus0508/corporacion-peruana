<div class="row">
  <!-- left column -->
  <form action="{{route('egreso_transporte.store')}}" method="POST">
    @csrf
    <div class="col-md-5">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Datos del Transporte</h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group @error('tipo') has-error @enderror">
                <label for="tipo">Tipo</label>
                <select id="tipo" class="form-control"  required="">                        
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
          <div class="col-md-6">
              <div class="form-group @error('placa') has-error @enderror">
                <label for="placa">Placa</label>
                <select id="placa" class="form-control" name="transporte_id" required="">   
                </select>
              </div>
          </div>
          <div class="col-md-6">
                <div class="form-group @error('fecha_reporte') has-error @enderror">
                  <label for="fecha_reporte">Fecha para reporte</label>
                  <input autocomplete="off" id="fecha_reporte" type="text" class="tuiker form-control" required="" 
                  name="fecha_reporte" placeholder="Ingrese la fecha de reporte">
                  @error('fecha_reporte')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>        
             <div class="col-md-6">
                <div class="form-group">
                      <br>
                      <button class="btn form-control btn-success">
                      <i class="fa fa-save"> </i>
                       Registrar Egreso
                      </button>
                </div>
            </div>
          </div>          
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (left) -->  
  <div class="col-md-7">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Datos complementarios</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">                   
            <div class="col-md-4  ">
              <div class="form-group">
                <label for="tipo_comprobante">Comprobante</label>
                <select id="tipo_comprobante" class="form-control" name="tipo_comprobante">  
                  <option value="1">Boleta</option>
                  <option value="2">Factura</option>
                  <option value="3">Ticket</option>
                  <option value="4">Comprobante interno</option>
                  <option value="5">Proforma simple</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
                <div class="form-group @error('fecha_egreso') has-error @enderror">
                  <label for="fecha_egreso">Fecha de egreso</label>
                  <input autocomplete="off" id="fecha_egreso" type="text" 
                  class="tuiker form-control" required="" 
                  name="fecha_egreso" placeholder="Fecha de egreso">
                  @error('fecha_egreso')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

            <div class="col-md-4">
              <div class="form-group @error('monto_egreso') has-error @enderror">
                <label for="monto_egreso">Monto</label>
                <input id="monto_egreso" type="number" class="form-control" value="{{old('monto_egreso')}}" required
                        name="monto_egreso" placeholder="Ingrese el Monto" required>
                @error('monto_egreso')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
             <div class="col-md-4">
              <div class="form-group @error('nro_comprobante') has-error @enderror">
                <label for="nro_comprobante">Numero de comprobante</label>
                <input id="nro_comprobante" type="tel" class="form-control" value="{{old('nro_comprobante')}}" required
                        name="nro_comprobante" placeholder="Número de comprobante" required>
                @error('nro_comprobante')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group @error('descripcion') has-error @enderror">
                <label for="descripcion">Descripción</label>
                <input id="descripcion" type="tel" class="form-control"
                     value="{{old('descripcion')}}" 
                        name="descripcion" placeholder="Ingrese la   descripcion" required>
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
  </form>   
</div> <!-- /.row-top -->
