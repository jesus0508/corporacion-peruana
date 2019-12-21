<form action="{{route('factura_proveedor.update',$pedido->id)}}" method="post">
  @csrf
  @method('PUT')
  <input type="hidden" id="pedido_asignar_transportista" name="id_pedido">
  <div class="row">
      <div class="col-md-12">
        <div class="box box-success collapse in" id="collapseCisterna">
          <div class="box-header with-border">
            <div class="row">
              <div class="col-md-6">
                <h3 class="box-title">Datos Vehiculo | <b> Transportista</b>  
                <span id="nombre_transportista" class="label label-primary">   
                  @nombreTransportista              
                </span>
                </h3>
              </div>
              <div class="col-md-6">
                &nbsp;&nbsp;&nbsp;
                <h3 class="box-title">Datos Chofer | <b> Transportista</b>                  
                </h3>                 
              </div>              
            </div>            
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="placa">Placa*</label>
                      <select class="form-control" id="placa" name="vehiculo_id" required="">
                        @foreach ( $vehiculos as $vehiculo)
                          <option value="{{$vehiculo->id}}">{{$vehiculo->placa}}</option>
                        @endforeach
                      </select>                  
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="capacidad">Capacidad galones</label>
                      <input id="capacidad" type="text" name="capacidad" class="form-control" readonly=""> 
                    </div>
                  </div>                  
                </div> 
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group ">
                      <label for="detalle_compartimiento">Detalle Compartimiento</label>
                      <textarea id="detalle_compartimiento" name="detalle_compartimiento" readonly="" rows="3" class="form-control">                   
                      </textarea>
                    </div>
                  </div>
                  
                </div>               
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="form-group @error('chofer') has-error @enderror">
                        <label for="chofer">Nombre Chofer </label>
                        <input id="chofer" name="chofer" type="text" class="form-control" placeholder="Ingrese chofer asignado" value="{{ old('chofer') }}" >
                        @error('chofer')
                        <span class="help-block" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group @error('brevete_chofer') has-error @enderror">
                        <label for="brevete_chofer">Brevete Chofer </label>
                        <input id="brevete_chofer" name="brevete_chofer" type="text" class="form-control" placeholder="Ingrese el brevete de chofer" value="{{ old('brevete_chofer') }}">
                        @error('brevete_chofer')
                        <span class="help-block" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>                    
                  </div>                
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="form-group @error('costo_flete') has-error @enderror">
                        <label for="costo_flete"> Pago transportista *</label>
                        <input id="costo_flete" name="costo_flete" type="number" class="form-control" placeholder="Ingrese monto correspondiente" required="" step="any" 
                        min="0"  max="9999" 
                         value="{{ old('costo_flete') }}">
                        @error('costo_flete')
                          <span class="help-block" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label for="nombre_transportista">Asigne pedido a transportista</label>
                       <button class="btn btn-success btn-block"> <span class="fa fa-chain"> </span>&nbsp;Asignar transportista</button>
                      </div>
                    </div>                    
                  </div>                  
                </div>
                
              </div>
            </div> <!-- End row collapse-->
          </div> <!-- Box-body End -->
        </div><!-- Box  End -->
      </div><!-- col-md-12  End -->
    </div> <!-- row   End -->
</form>   

