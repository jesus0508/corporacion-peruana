<div class="row">
<!--   <form class="modal-content" action="{{route('gastos.store')}}" method="post">
    @csrf -->
  <div class="col-md-12">
  <div class="box box-success" id="">
    <div class="box-header with-border">
      <h3 class="box-title">Nuevo gasto &nbsp;|&nbsp; <b>Nuevo Concepto GASTO</b></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group @error('categoria') has-error @enderror">
            <label for="categoria">Categoría Gasto</label>
            <select name="categoria" id="categoria" class="form-control">
              @foreach( $categorias as $categoria )
                <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group @error('subcategoria') has-error @enderror">
            <label for="subcategoria">SubCategoría Gasto</label>
            <select name="subcategoria" id="subcategoria" class="form-control">

            </select>
          </div>
        </div>          
        </div>        
      <div class="row">
        <div class="col-md-8">
          <div class="form-group @error('concepto') has-error @enderror">
            <label for="concepto">Concepto gasto*</label>
            <select name="concepto_gasto_id" id="concepto" class="form-control">
            </select>
          </div>  
        </div>          
        <div class="col-md-4">
          <div class="form-group @error('codigo_gasto') has-error @enderror">
            <label for="codigo_gasto">Código gasto</label>
            <input id="codigo_gasto" type="text" class="form-control"  readonly="">
            @error('codigo_gasto')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>          
        </div>        
      </div> <!-- end- row-->
      <div class="row">
      	<div class="col-md-4">
          <div class="form-group @error('monto_egreso') has-error @enderror">
            <label for="monto_egreso">Monto gasto*</label>
            <input id="monto_egreso" type="text" class="form-control" name="monto_egreso" placeholder=" Ingrese el monto"  required>
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
            <input id="fecha_egreso" type="date" class="form-control" name="fecha_egreso" placeholder="Ingrese fecha monto "  required>
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
            <select name="grifo_id" id="grifo_id" class="form-control">
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
 <!--  </form>  -->  <!-- end- form-->
</div>