        <div id="datos-vehiculo" class="box box-success">
          <div class="box-header with-border">
              <div class="row">
                <div class="col-md-8">
                  @if( $pedido->vehiculo_id == null ) 
                    <h3 class="box-title"> Datos Transportista   </h3>
                  @else
                    <h3 class="box-title"> Datos Transportista |
                      <a href="{{route('vehiculo.show',$id_t)}}">{{$transportista}}</a>
                  @endif
                </div> 
              </div>
           <input type="hidden" id="pedido_asignar_transportista" name="id_pedido">
          </div><!-- /.box-header -->
          <div class="box-body">
            <div id="" class="row">
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="placa">Placa</label>
                  
                    @if( $pedido->vehiculo_id != null ) 
                      <input id="placa" value="{{$pedido->vehiculo->placa}}" type="text" class="form-control" readonly>                  
                    @else
                      <input id="placa" value="FLETE PROPIO" type="text" class="form-control" readonly>
                    @endif
                
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="nombre_transportista">Nombre Transportista</label>
                    <input id="nombre_transportista" value="{{$transportista}}" type="text" class="form-control" readonly>                 
                </div>
              </div>
            </div>
            @if( !$pedido->vehiculo_id == null )
            <div id="" class="row">
              <div class="col-md-3">
                <div class="form-group ">
                  <label for="modelo">Capacidad</label>
                  <input id="modelo"  value="{{$pedido->vehiculo->capacidad}}" type="text" class="form-control" readonly>
                  
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-group ">
                  <label for="marca">Detalle compartimiento</label>
                  <textarea name="" id="" class="form-control" cols="30" rows="3" readonly="">
                    {{$pedido->vehiculo->detalle_compartimiento}}
                  </textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label for="chofer">Chofer</label>
                  <input id="chofer"  value="{{$pedido->chofer}}" type="text" class="form-control" readonly>
              </div>
              <div class="col-md-4">
                <label for="chofer">Brevete Chofer</label>
                  <input id="chofer"  value="{{$pedido->brevete_chofer}}" type="text" class="form-control" readonly>
              </div>
              <div class="col-md-4">
                <label for="chofer">Costo Flete</label>
                  <input id="chofer"  value="{{$pedido->costo_flete}}" type="text" class="form-control" readonly>
              </div>              
            </div>
            @endif

          </div><!-- /.box-body -->
        </div><!-- /.box producto-->