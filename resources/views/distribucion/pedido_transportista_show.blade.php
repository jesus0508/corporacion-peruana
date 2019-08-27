<div class="row">   
	<div class="col-md-12">
        <div class="box box-success collapse " id="collapseCisternaShow">
          <div class="box-header with-border">
            <div class="row">
              <div class="col-md-6">
                <h3 class="box-title">Datos Vehiculo | <b> Transportista</b>  
                <span id="nombre_transportista" class="label label-primary">   
                  {{$vehiculo_asignado->transportista->nombre_transportista}}              
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
                      <input type="text" class="form-control" disabled="" 
                      	value="{{$vehiculo_asignado->placa}}">                
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="capacidad">Capacidad galones</label>
                      <input id="capacidad" type="text" name="capacidad" class="form-control" 
                       value="{{$vehiculo_asignado->capacidad}}" disabled="" > 
                    </div>
                  </div>                  
                </div> 
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group ">
                      <label for="detalle_compartimiento">Detalle Compartimiento</label>
                      <textarea id="detalle_compartimiento" name="detalle_compartimiento" disabled="" rows= "3" class="form-control">  
                                {{$vehiculo_asignado->detalle_compartimiento}}
                      </textarea>
                    </div>
                  </div>
                  
                </div>               
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label for="chofer">Nombre Chofer</label>
                        <input id="chofer" name="chofer" type="text" class="form-control" placeholder="Ingrese chofer asignado" disabled="" value="{{$pedido->chofer}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label for="brevete_chofer">Brevete Chofer</label>
                        <input id="brevete_chofer" name="brevete_chofer" type="text" class="form-control" placeholder="Ingrese el brevete de chofer" value="{{$pedido->brevete_chofer}}"	disabled="">
                      </div>
                    </div>                    
                  </div>                
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label for="costo_flete"> Pago transportista *</label>
                        <input id="costo_flete" name="costo_flete" type="text" class="form-control" placeholder="Ingrese monto correspondiente" value="{{$pedido->costo_flete}}" disabled="">
                      </div>
                    </div>
                    <div class="col-md-6">
   
                    </div>                    
                  </div>                  
                </div>
                
              </div>
            </div> <!-- End row collapse-->
          </div> <!-- Box-body End -->
        </div><!-- Box  End -->

    </div><!-- col-md-12  End -->
</div>

