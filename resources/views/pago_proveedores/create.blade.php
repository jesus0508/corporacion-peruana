<div class="row">
  <form class="" action="{{route('pago_proveedors.store')}}" method="post">
    @csrf
          <!-- left column -->
          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales Operación</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="fecha_operacion">Fecha</label>
                  <input id="fecha_operacion" type="date" class="form-control"
                          name="fecha_operacion" placeholder="Ingrese la fecha" required>
                </div>
                <div class="form-group">
                    <label for="codigo_operacion">Codigo de operacion</label>
                    <input id="codigo_operacion" type="text" class="form-control"
                            name="codigo_operacion" placeholder="Ingrese el codigo de la operacion" required>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales Operación</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="monto_operacion">Monto</label>
                  <input id="monto_operacion" type="number" step="any" class="form-control"
                          name="monto_operacion" placeholder="Ingrese el monto de la operacion" required>
                </div>
                <div class="form-group">
                  <label for="banco">Banco</label>
                  <select class="form-control" id="banco" name="banco" placeholder="Seleccione el banco">
                    <option value="BCP">BCP</option>
                    <option value="BBVA">BBVA</option>
                    <option value="SCOTIBANK">SCOTIBANK</option>
                  </select>
                </div>
                <input type="hidden" name="proveedor_id" value="{{$proveedor->id}}">
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->

<div class="col-md-12">
  <div class="form-group">
        <button type="submit" class="btn btn-lg btn-success">
          <i class="fa fa-money"> </i>
          Realizar PAGO en BLOQUE
        </button>
      </div>
</div>
  </form>
</div> <!-- /.row-top -->
