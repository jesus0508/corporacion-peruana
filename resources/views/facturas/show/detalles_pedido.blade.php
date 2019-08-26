      <div class="col-md-4">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Detalles Pedido</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-lg-6">
                <label for="fecha_pedido">Fecha de Pedido</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="fecha_pedido" value="{{$pedido->created_at}}" type="text" class="form-control" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label for="planta_AR">Planta</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="planta_AR" type="text" value="{{$pedido->planta->planta}}" class="form-control" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label for="costo_galon">Precio Unidad</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="costo_galon" value="{{$pedido->costo_galon}}" type="text" class="form-control" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label for="galones">Cantidad de Galones</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="galones" value="{{$pedido->galones}}" type="text" class="form-control" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label for="total">Monto Total</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="total" value="{{number_format((float)
                    $pedido->galones*$pedido->costo_galon, 2, '.', '') }}" type="text" class="form-control" readonly>
                </div>
              </div>
            </div>
               <div class="row">
              <div class="col-lg-6">
                <label for="diferencia">Diferencia</label>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="diferencia" type="text" class="form-control" readonly>
                </div>
              </div>
            </div>
         
          </div>
        </div>
      </div> 
