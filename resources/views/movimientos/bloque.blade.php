<div class="modal fade" id="modal-create-pago_bloque" style="display: none;">
  <div class="modal-dialog">
    {{-- <form action="{{route('pago_clientes.pagoBloque',2)}}" method="post" class="modal-content pago"> --}}
    <div class="modal-content pago">
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
                <h3 class="box-title">Datos del Cliente</h3>
                
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="seletc-clientes">Cliente</label>
                      <select class="form-control" id="seletc-clientes" name="cliente_id" >
                      </select>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
        </div> 
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div id="datos-pago" class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="fecha_operacion-pago_bloque">Fecha</label>
                  <input id="fecha_operacion-pago_bloque" type="text" class="form-control"
                          name="fecha_operacion" placeholder="Ingrese la fecha" required>
                </div>
                <div class="form-group">
                  <label for="codigo_operacion-pago_bloque">Codigo de operacion</label>
                  <input id="codigo_operacion-pago_bloque" type="text" class="form-control"
                          name="codigo_operacion" placeholder="Ingrese el codigo de la operacion" required>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="monto_operacion-pago_bloque">Monto</label>
                      <input id="monto_operacion-pago_bloque" type="number" step="any" class="form-control"
                              name="monto_operacion" placeholder="Ingrese el monto de la operacion" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="saldo-pago_bloque">Saldo</label>
                      <input id="saldo-pago_bloque" type="number" step="any" class="form-control"
                              name="saldo" readonly>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="banco-pago_bloque">Banco</label>
                  <select class="form-control" id="banco-pago_bloque" name="banco" placeholder="Seleccione el banco">
                    <option value="BCP">BCP</option>
                    <option value="BBVA">BBVA</option>
                    <option value="SCOTIBANK">SCOTIBANK</option>
                  </select>
                </div>
                <input id="cliente_id-pago_bloque" type="hidden" name="cliente_id">             
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
        </div> 
      </div>
      <div class="modal-footer">
        <button id="btn-pago-bloque" type="submit" class="btn btn-primary pull-left">Registrar Pago</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
  