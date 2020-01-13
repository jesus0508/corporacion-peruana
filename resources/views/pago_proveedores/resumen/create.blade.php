<div class="row">
   <!-- left column -->
  <div class="col-md-6">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Datos principales Operación</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="fecha_operacion">Fecha Operación</label>
              <input type="text" class="form-control"
                  name="fecha_operacion" 
                  value="{{date('d/m/Y', strtotime($pago_proveedor->fecha_operacion))}}" disabled>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="fecha_operacion">Fecha Egreso</label>
              <input type="text" class="form-control"
                  name="fecha_operacion" 
                  value="{{date('d/m/Y', strtotime($pago_proveedor->fecha_reporte))}}" disabled>
            </div>
          </div>          
        </div>
        <div class="form-group">
                    <label for="codigo_operacion">Codigo de operacion</label>
                    <input  type="text" class="form-control"
                            name="codigo_operacion" value="{{$pago_proveedor->codigo_operacion}}"  disabled>
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
                  <input  type="number" class="form-control"
                          name="monto_operacion" value="{{$pago_proveedor->monto_operacion}}" disabled>
                </div>
                <div class="form-group">
                  <label for="banco">Banco</label>
                  <input  type="text" value="{{$pago_proveedor->banco}}" class="form-control"
                          name="banco" disabled>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
</div> <!-- /.row-top -->

