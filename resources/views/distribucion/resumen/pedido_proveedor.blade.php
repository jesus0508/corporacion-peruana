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
                <label for="saldo">TOTAL galones por distribuir</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input name="galones_dist"  type="number" class="form-control" value="{{$pedido->getGalonesStock()}}" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label for="saldo">TOTAL galones distribuidos</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input name="galones_dist"  type="number" class="form-control" value="{{$pedido->galones_distribuidos}}" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 top-button">
          <!--    {{route('pedidos.show', $pedido->id)}} -->
                <a href=" {{route('pedidos.show', $pedido->id)}}" class="btn btn-info">
                  <i class="fa fa-eye"> </i>
                  Ver Pedido Proveedor
                </a>


              </div>
            </div>
          </div>
        </div>
      </div> <!--/.col (right) -->
    </div> <!-- /.row-top -->