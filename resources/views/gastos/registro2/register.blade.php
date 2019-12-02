<div class="row">
  <form class="modal-content" action="{{route('egresos.store')}}" method="post">
    @csrf
  <div class="col-md-12">
    <div class="box box-success" id="">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-md-4">
            <h3 class="box-title"> Registrar GASTOS Grifo</h3>
          </div>
          <div class="col-md-2">
            <b>¿Cómo desea seleccionar?  </b>
          </div> 
          <div class="col-md-3">                    
            <div class="radio">
              <label><input type="radio" id="radio1" name="opcion" value="1" checked>Por Código</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="radio">
              <label><input type="radio"  id="radio2" name="opcion" value="2">Por Concepto</label>
            </div>
          </div>
        </div>
      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group @error('categoria') has-error @enderror">
              <label for="categoria">Categoría Gasto</label>
              <input type="text" class="form-control" id="categoria_gasto" readonly="">          
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group @error('subcategoria') has-error @enderror">
              <label for="subcategoria">SubCategoría Gasto</label>
              <input type="text" class="form-control" id="subcategoria_gasto" readonly="">
            </div>          
          </div>  
        </div>      
        <div class="row">
          <div class="col-md-8">
            <div class="form-group @error('concepto') has-error @enderror">
              <label for="concepto">Concepto gasto*</label>
              <select name="" id="concepto_name" class="form-control">
                @foreach( $conceptos as $concepto )
                  <option value="{{$concepto->id}}">{{$concepto->concepto}}</option>
                @endforeach
              </select>
            </div>  
          </div>          
          <div class="col-md-4">
            <div class="form-group @error('codigo_gasto') has-error @enderror">
              <label for="codigo_gasto">Código gasto</label>
              <select name="concepto_gasto_id" id="concepto_id" class="form-control">
                @foreach( $conceptos as $concepto )
                  <option value="{{$concepto->id}}">{{$concepto->codigo}}</option>
                @endforeach
              </select> 
            </div>          
          </div>        
        </div> <!-- end- row-->
        <div class="row">
        	<div class="col-md-4">
            <div class="form-group @error('monto_egreso') has-error @enderror">
              <label for="monto_egreso">Monto gasto*</label>
              <input id="monto_egreso" type="number" class="form-control" name="monto_egreso" placeholder=" Ingrese el monto" step="any" min="0" max="999999" required>
              @error('monto_egreso')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
           </div>
           <div class="col-md-4">
            <div class="form-group @error('fecha_egreso') has-error @enderror">
              <label for="fecha_egreso">Fecha egreso</label>
              <input autocomplete="off" id="fecha_egreso" type="text" class="tuiker 
              form-control"  name="fecha_egreso" placeholder="Ingrese día" required="">
              @error('fecha_gasto')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
        	</div> 
           <div class="col-md-4">
            <div class="form-group @error('grifo_id') has-error @enderror">
              <label for="grifo_id">Grifo</label>
              <select name="grifo_id" id="grifo_id" class="form-control" required="">
                @foreach( $grifos as $grifo )
                  <option value="{{$grifo->id}}">{{$grifo->razon_social}}</option>
                @endforeach
              </select>
            </div>
          </div>      	
        </div> <!-- end-row -->
      </div><!-- end-bx-body-->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
      <div class="box-footer">
        <button id="btn_register" type="submit" class="btn pull-right btn-success">
              <i class="fa fa-chain"> </i>
                Registrar nuevo gasto
        </button>
            
      </div><!-- /.box-footer -->
      
    </div> <!-- end- box-->
  </div>
  </form>
</div>