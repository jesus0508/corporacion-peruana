        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Datos Pedido Proveedor</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nro_pedido">Pedido</label>
                  <select class="form-control" id="nro_pedido" name="id_pedido" required>
                    @foreach ( $pedidos as $pedido )
                      <option value="{{$pedido->id}}">{{$pedido->nro_pedido}}</option>
                    @endforeach
                  </select>
                </div>
              </div><!-- end razon -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="scop">SCOP pedido</label>
                  <input id="scop" type="text" class="form-control" 
                          name="scop" readonly>
                </div>
              </div><!-- end ruc -->
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box datos pedido -->