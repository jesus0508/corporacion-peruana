<div class="row">
  <!-- left column -->
  <form action="{{route('ingreso_transporte.store')}}" method="POST">
    @csrf
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Registro Ingresos Transporte: Buses</h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-2  ">
              <div class="form-group @error('tipo') has-error @enderror">
                <label for="tipo">Tipo</label>
                <select id="tipo" class="form-control"
                  name="tipo" disabled>                 
                  <option  value="2">Buses</option>               
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group @error('placa') has-error @enderror">
                <label for="placa">Placa</label>
                   <select id="placa" class="form-control"
                  name="transporte_id" >   
                  @foreach($transportes as $transporte)
                    <option value="{{$transporte->id}}">{{$transporte->placa}}</option>
                  @endforeach                                
                </select>
              </div>
            </div>
            <div class="col-md-2">
                  <div class="form-group @error('fecha_reporte') has-error @enderror">
                    <label for="fecha_reporte">Fecha reporte</label>
                    <input autocomplete="off" id="fecha_reporte" type="text" class="tuiker form-control"
                    name="fecha_reporte" placeholder="Fecha de reporte">
                    @error('fecha_reporte')
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
                  name="fecha_ingreso" placeholder="Fecha de ingreso">
                  @error('fecha_ingreso')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

            <div class="col-md-2">
              <div class="form-group @error('monto_ingreso') has-error @enderror">
                <label for="monto_ingreso">Monto Ingreso</label>
                <input id="monto_ingreso" type="number" class="form-control" value="{{old('monto_ingreso')}}" required step="any" min="1" 
                        name="monto_ingreso" placeholder="Ingrese el monto" required>
                @error('monto_ingreso')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div>
            
            <div class="col-md-2">
              <div class="form-group">
                <br>                
                <!-- <label for=""> .</label> -->
                <button type="submit" class="btn btn-success form-control">
                  <i class="fa fa-save"> </i>
                    Registrar Ingreso
                </button>
              </div>
            </div>

          </div>
          
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (left) -->
  </form> 
</div> <!-- /.row-top -->
