<div class="row">
  <form class="" action="{{route('traslado_galones.store')}}"  method="post">
    @csrf
		<div class="col-md-12">
		      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Registrar programación pedidos:</h2>
        </div><!-- /.box-header -->
        <div class="box-body" >
          <div class="row"  id="input-user-edit">
            <div class="col-md-2">
              <div class="form-group @error('fecha') has-error @enderror">
                  <label for="fecha">Fecha*</label>
                  <input autocomplete="off" id="fecha" type="text" class=" form-control" placeholder="Fecha " 
                  name="fecha"   required="" >
                  @error('fecha')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="tipo">Tipo*</label>
                <select class="form-control" id="tipo" name="tipo" required>
                  <option value="-1" default>Seleccione</option>      
                  <option value="1">GRifos</option>
                  <option value="2">Clientes</option>                          
                </select>             
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="grifo_id">Grifo|Cliente*</label>
                <select class="form-control" id="select_grifos" name="grifo_id" required>                               
                </select>             
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                  <label for="stock">Stock*</label>
                  <input autocomplete="off" id="stock" type="text" class="tuiker form-control" placeholder="Stock " 
                  name="stock"   readonly="">            
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="proveedor_id">Proveedor*</label>
                <select class="form-control" id="proveedor_id" name="proveedor_id" required>       
                  @foreach($proveedores as $proveedor)
                  <option value="{{$proveedor->id}}">{{$proveedor->razon_social}}</option>
                  @endforeach                        
                </select>             
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group @error('horario') has-error @enderror">
                  <label for="horario">Horario</label>
                  <input autocomplete="off" id="horario" type="text" class="form-control" placeholder="horario " 
                  name="horario" >
                  @error('horario')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group @error('cantidad') has-error @enderror">
                  <label for="cantidad">Cantidad*</label>
                  <input autocomplete="off" id="cantidad" step="any" min="0" type="number" class="tuiker form-control" placeholder="cantidad " 
                  name="cantidad"   required="" >
                  @error('cantidad')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                  <label for="nuevo_stock">Nuevo stock*</label>
                  <input autocomplete="off" id="nuevo_stock" type="text" class="tuiker form-control" placeholder="nuevo stock " 
                  name="nuevo_stock"   readonly="">            
              </div>
            </div>
          </div>
          <div class="col-md-12">
          	<button class="btn btn-lg btn-success pull-right"> <span class="fa fa-save"></span>	 &nbsp;Registrar</button>
          </div>
				</div>
			</div>
		</div> {{-- end-div.col.md.12 --}}
	</form>
</div>