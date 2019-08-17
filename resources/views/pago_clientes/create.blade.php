<div class="modal fade" id="modal-create-pago" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('pago_clientes.store')}}" method="post" class="modal-content pago">
      @csrf
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Registrar Pago</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="fecha_operacion">Fecha</label>
                  <input id="fecha_operacion" type="text" class="form-control" autocomplete="off"
                          name="fecha_operacion" placeholder="Ingrese la fecha" required>
                </div>
                <div class="form-group">
                  <label for="codigo_operacion">Codigo de operacion</label>
                  <input id="codigo_operacion" type="text" class="form-control"
                          name="codigo_operacion" placeholder="Ingrese el codigo de la operacion">
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="monto_operacion">Monto</label>
                      <input id="monto_operacion" type="number" step="any" class="form-control"
                              name="monto_operacion" placeholder="Ingrese el monto de la operacion" required min="0">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="saldo-pago">Saldo</label>
                      <input id="saldo-pago" type="number" step="any" class="form-control"
                              name="saldo" readonly>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="banco">Banco</label>
                  <select class="form-control" id="banco" name="banco" placeholder="Seleccione el banco" required>
                    <option value="BCP">BCP</option>
                    <option value="BBVA">BBVA</option>
                    <option value="SCOTIBANK">SCOTIBANK</option>
                  </select>
                </div>
                <input id="nro_pedido-pago" type="hidden" name="nro_pedido">
                <input id="pedido_cliente_id-pago" type="hidden" name="pedido_cliente_id">
                
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
        </div> 
        <input id="id-create" type="hidden" name="id">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left">Registrar Pago</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
