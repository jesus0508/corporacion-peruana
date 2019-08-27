  
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
                    <input type="text" class="form-control" value="{{$pedido->nro_pedido}}" readonly>
                </div>
              </div><!-- end razon -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="scop">SCOP</label>
                  <input id="scop" value="{{$pedido->scop}}" type="text" class="form-control"  name="scop" readonly>
                </div>
              </div><!-- end ruc -->
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="galones">Galones Pedido </label>
                  <input class="form-control" id="cliente" value="{{$pedido->galones}}" readonly="">

                </div>
              </div><!-- end razon -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="planta">Planta</label>
                  <input id="planta" type="text" class="form-control" 
                          name="planta" value="{{$pedido->planta->planta}}" readonly>
                </div>
              </div><!-- end ruc -->
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box datos cliente -->
       
      </div>

      <div class="col-md-4">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Detalles Pedido</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-lg-6">
                <label for="fecha_pedido">GALONES por distribuir</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input name="galones_stock" id="galones_stock" type="number" class="form-control" value="{{$pedido->getGalonesStock()}}" readonly="">
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
          @if( $suma == null or $suma == 0 or $pedido->getGalonesStock() == 0 )
            @if( $pedido->getGalonesStock() == 0 )
                 <a href="{{route('pedidos.ver_distribucion', $pedido->id)}}" class="btn btn-primary pull-right "><i class="fa fa-eye"> &nbsp; </i>Ver Distribución</a>
            @endif
          @else
            <div class="row" style="display: none;">
              <div class="col-lg-6">
                <label for="saldo">TOTAL a Distribuir</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input name="galones_dist" id="galonesTOdistribuir" type="number" class="form-control" value="{{$pedido->getGalonesStock()}}">
                </div>
              </div>
            </div>
            <div class="row" style="display: none;">
              <div class="col-md-12 top-button">
                
                <button type="submit" class="btn btn-lg btn-success"> 
                  <i class="fa fa-th"> </i>
                  Distribuir en bloque
                </button>

              </div>
            </div>
          @endif  
          </div><!-- end-box-body-->
        </div> <!-- end-box-->

      </div> <!--/.col (right) -->
    </div> <!-- /.row-top -->
  </form> 
    <!-- BOTONES + COLLAPSE --> 
 