
    <form action="{{route('pedidos.distribuir_pedido',$pedido->id)}}" method="post">
      @csrf
      @method('PUT')
     <input type="hidden" name="pedido_id" class="form-control" value="{{$pedido->id}}">
    <div class="row">
      <!-- left column -->
      <div class="col-md-8">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Datos Pedido proveedor</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cliente">Número Pedido</label>
                    <input type="text" class="form-control" value="{{$pedido->nro_pedido}}" disabled>
                </div>
              </div><!-- end razon -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="scop">SCOP</label>
                  <input id="scop" value="{{$pedido->scop}}" type="text" class="form-control"  name="scop" disabled>
                </div>
              </div><!-- end ruc -->
            </div>
                        <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="galones">Galones Pedido </label>
                  <input class="form-control" id="cliente" value="{{$pedido->galones}}" disabled="">

                </div>
              </div><!-- end razon -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="planta">Planta</label>
                  <input id="planta" type="text" class="form-control" 
                          name="planta" value="{{$pedido->planta->planta}}" disabled>
                </div>
              </div><!-- end ruc -->
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box datos cliente -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Datos Cisterna</h3>
          </div>
          <div class="box-body">
            <div class="row">              
          <div class="col-md-6">
            <div class="form-group ">
              <label for="placa">Placa*</label>
              <select class="form-control" id="placa" name="placa">
              @foreach ( $vehiculos as $vehiculo)
                <option value="{{$vehiculo->id}}">{{$vehiculo->placa}}</option>
              @endforeach
              </select>                  
            </div>
          </div>

            <div class="col-md-6">
              <div class="form-group ">
                <label for="nombre_transportista">Nombre Transportista</label>
                <input id="nombre_transportista" type="text" class="form-control" readonly="">
              </div>
            </div>
          </div>

          <div id="" class="row">
            <div class="col-md-6">
              <div class="form-group ">
                <label for="modelo">Capacidad galones</label>
                <input id="modelo" type="text" class="form-control" readonly="">
                  
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group ">
                  <label for="marca">Celular</label>
                  <input id="marca" type="text" class="form-control" readonly="">
            </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group ">
                  <label for="marca">Detalle Compartimiento</label>
                  <textarea readonly="" class="form-control">
                    
                  </textarea>
              </div>              
            </div>            
          </div>
          </div> <!-- Box-body End -->
        </div>
      </div>

      <div class="col-md-4">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Detalles Pedido</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-lg-6">
                <label for="fecha_pedido">GALONES en Stock</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input name="galones_stock" id="galones_stock" type="number" class="form-control" value="{{$pedido->getGalonesStock()}}" disabled="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label for="saldo">TOTAL a Distribuir</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input name="galones_dist" id="galonesTOdistribuir" type="number" class="form-control" value="{{$pedido->getGalonesStock()}}">
                </div>
              </div>
            </div>
            @php
            $suma = 0;
            @endphp

            @foreach ($pedidos_cl as $pedido_cliente)
              @php
                $suma += $pedido_cliente->galones - $pedido_cliente->galones_asignados;
              @endphp
            @endforeach
            <div class="row">
              <div class="col-md-12 top-button">
                @if( $pedido->getGalonesStock() == 0 or $suma == 0 )
                <button type="submit" class="btn btn-lg btn-success" disabled>
                  <i class="fa fa-th"> </i>
                  Distribuir
                </button>
                @else
                <button type="submit" class="btn btn-lg btn-success">
                  <i class="fa fa-th"> </i>
                  Distribuir
                </button>

                @endif
              </div>
            </div>
          </div><!-- end-box-body-->
        </div> <!-- end-box-->
        <div class="box box-success">
          <div class="box-header with-border">
            <h2 class="box-title">Detalles chofer</h2>            
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-lg-6">
                <label for="saldo">Chofer:</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input name="galones_dist" id="galonesTOdistribuir" type="number" class="form-control" >
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label for="saldo">Brevete</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input name="galones_dist" id="galonesTOdistribuir" type="number" class="form-control">
                </div>
              </div>
            </div>
             <div class="row">
              <div class="col-md-12 top-button">
                <button type="submit" class="btn btn-lg btn-success" disabled>
                  <i class="fa fa-pencil"> </i>
                  ASIGNAR
                </button>
              </div>
            </div>
            
          </div>          
        </div>
      </div> <!--/.col (right) -->
    </div> <!-- /.row-top -->
  </form> 