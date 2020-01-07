<div class="row">
  <!-- left column -->
  <form class="" action="{{route('stock_grifos.store')}}" method="post">
    @csrf
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Registrar stock grifo</h2>
        </div><!-- /.box-header -->
        <div class="box-body" id="input_user">
          <div class="row" id="input_user_top">
            <div class="col-md-3">
              <div class="form-group @error('fecha_stock') has-error @enderror">
                  <label for="fecha">Fecha*</label>
                  <input autocomplete="off" id="fecha_stock" type="text" class="tuiker form-control" placeholder="Fecha Stock" 
                  name="fecha_stock"   required="" >
                  @error('fecha_stock')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="grifo_id">Grifo</label>
                <select class="form-control" id="select_grifos" name="grifo_id" required>                               
                </select>             
              </div>
            </div>
             <div class="col-md-2">
              <div class="form-group @error('stock_sistema') has-error @enderror">
                <label for="stock_sistema">Stock sistema</label>
                <input id="stock_sistema" style="background-color: #C1E74A;"  class="form-control" name="stock_sistema" placeholder="Stock sistema" 
                  required="" readonly="">
                @error('stock_sistema')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group  @error('lectura_inicial') has-error @enderror">
                <label for="lectura_inicial">Lectura Inicial</label>
                <input id="lectura_inicial" type="text" class="form-control" 
                        name="lectura_inicial" placeholder="Ingrese lectura inicial" 
                        required="" readonly="">
                @error('lectura_inicial')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group @error('lectura_final') has-error @enderror">
                <label for="lectura_final">Lectura Final</label>
                <input id="lectura_final" name="lectura_final" type="text" class="form-control" 
                        placeholder="Ingrese lectura final" required=""  readonly="">
                @error('lectura_final')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror        
              </div>
            </div>
          </div>                    
          <div class="row" id="">
            <div class="col-md-2">
              <div class="form-group @error('precio_galon') has-error @enderror">
                <label for="precio_galon">Precio galón</label>
                <input id="precio_galon" type="number" step="any" min="0" class="form-control" 
                        placeholder="Precio galón"  name="precio_galon" readonly="" required="" >
                @error('precio_galon')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group @error('calibracion') has-error @enderror">
                <label for="calibracion">Calibración</label>
                <input id="calibracion" type="number" step="any" min="0" class="form-control" 
                        placeholder="Calibracion"  name="calibracion" readonly="">
                @error('calibracion')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="venta_dia_anterior">Venta Dia Anterior</label>
                <input id="venta_dia_anterior" type="text" class="form-control" 
                        placeholder="Venta día anterior"  readonly="" >
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group @error('venta_soles') has-error @enderror">
                <label for="venta_soles">Venta Soles Galon</label>
                <input id="venta_soles" name="venta_soles" class="form-control" placeholder="Venta soles " required="" readonly="">
                @error('venta_soles')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group @error('nuevo_stock') has-error @enderror">
                <label for="nuevo_stock">Nuevo Stock</label>
                <input id="nuevo_stock" style="background-color: #C1E74A;"  class="form-control" name="nuevo_stock" placeholder="Nuevo Stock" 
                  required="" readonly="">
                @error('nuevo_stock')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div> <!-- end.row -->
          <div class="row">
            <div class="col-md-3">
              <div class="form-group  @error('stock_grifo') has-error @enderror">
                <label for="stock_grifo">Stock según grifo</label>
                <input id="stock_grifo" class="form-control" name="stock_grifo" placeholder="Stock según grifo" required=""  readonly="">
                @error('stock_grifo')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group @error('stock_grifo') has-error @enderror">
                <label for="diferencia">Diferencia </label>
                <input id="diferencia" class="form-control"  placeholder="Diferencia" required="" readonly="">
                @error('stock_grifo')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            {{-- <div class="col-md-2">
              <div class="form-group @error('stock_grifo') has-error @enderror">
                <label for="traspaso">Traspaso</label>
                <input id="traspaso" class="form-control" name="traspaso" placeholder="Traspaso"
                readonly="">
                @error('stock_grifo')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group @error('stock_grifo') has-error @enderror">
                <label for="recepcion">Recepción</label>
                <input id="recepcion" class="form-control" name="recepcion" placeholder="Recepción"
                readonly="">
                @error('stock_grifo')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror              
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="new_stock">Nuevo Stock</label>
                <input id="new_stock" style="background-color: #C1E74A;" class="form-control" name="new_stock" placeholder="Nuevo stock"
                readonly="">
              </div>
            </div>
          </div> <!-- end.row -->
          <div class="row">
            <div class="col-md-2">
              <div class="form-group @error('cantidad_primax') has-error @enderror">
                <label for="cantidad_primax">PRIMAX</label>
                <input id="cantidad_primax"  class="form-control" name="cantidad_primax" placeholder="PRIMAX"     readonly="" >
                @error('cantidad_primax')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror              
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="horario_primax">Horario PRIMAX</label>
                <select name="horario_primax" id="horario_primax" class="form-control" disabled>
                  <!-- <option value="-1">Seleccione una opcion</option> -->
                  <option value="1">Primer Viaje</option>
                  <option value="2">Segundo Viaje</option>
                  <option value="3">Terce Viaje</option>
                  <option value="4">Propio Flete</option>
                  <option value="5">Prefactura</option>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group @error('cantidad_pbf') has-error @enderror">
                <label for="cantidad_pbf">PBF</label>
                <input id="cantidad_pbf"  class="form-control" name="cantidad_pbf" placeholder="PBF" 
                  readonly="">
                @error('cantidad_pbf')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror             
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="horario_pbf">Horario PBF</label>
                <select name="horario_pbf" id="horario_pbf" class="form-control" disabled>
                  <option value="1">Primer Viaje</option>
                  <option value="2">Segundo Viaje</option>
                  <option value="3">Terce Viaje</option>
                  <option value="4">Propio Flete</option>
                  <option value="5">Prefactura</option>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group @error('cantidad_pecsa') has-error @enderror">
                <label for="cantidad_pecsa">PECSA</label>
                <input id="cantidad_pecsa"  class="form-control" name="cantidad_pecsa" placeholder="PECSA"  readonly="">
              </div>
                @error('cantidad_pecsa')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror            
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="horario_pecsa">Horario PECSA</label>
                <select name="horario_pecsa" id="horario_pecsa" class="form-control" disabled>
                  <option value="1">Primer Viaje</option>
                  <option value="2">Segundo Viaje</option>
                  <option value="3">Tercer Viaje</option>
                  <option value="4">Propio Flete</option>
                  <option value="5">Prefactura</option>
                </select>
              </div>
            </div>      --}}         
          </div> <!-- end.row -->
            <div class="row col-md-12">
              <div class="form-group">                
              <button  type="submit" id="register" class="btn btn-lg btn-success pull-right" disabled="">
                <i class="fa fa-save"> </i>&nbsp;
                Registrar                
              </button>
              </div>              
            </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (left) -->
  </form>
</div> <!-- /.row-top -->


