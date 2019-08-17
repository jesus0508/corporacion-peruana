        <div id="datos-vehiculo" class="box box-success">
          <div class="box-header with-border">
              <div class="row">
                <div class="col-md-4">
                   <h3 class="box-title"> Datos Transportista</h3>
                </div>
                <div class="col-md-4 pull-right">
                 
                </div>
              </div>
           <input type="hidden" id="pedido_asignar_transportista" name="id_pedido">

          </div><!-- /.box-header -->
          <div class="box-body">
            <div id="" class="row">
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="placa">Placa*</label>
                  <select class="form-control" id="placa" name="placa" disabled>

                      <option selected="true">{{$transportista}}</option>

                  </select>
                  
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="nombre_transportista">Nombre Transportista</label>
                  <input id="nombre_transportista" value="{{$transportista}}" type="text" class="form-control" disabled>
                </div>
              </div>
            </div>
            @if( $pedido->vehiculo_id == null )
            @else
            <div id="" class="row">
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="modelo">Capacidad</label>
                  <input id="modelo"  value="{{$pedido->vehiculo->capacidad}}" type="text" class="form-control" disabled>
                  
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="marca">Detalle compartimiento</label>
                  <input id="marca" value="{{$pedido->vehiculo->detalle_compartimiento}}" type="text" class="form-control" disabled>
                </div>
              </div>
            </div>
            @endif

          </div><!-- /.box-body -->
        </div><!-- /.box producto-->