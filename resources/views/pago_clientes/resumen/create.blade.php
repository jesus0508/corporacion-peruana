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
                  value="{{date('d/m/Y', strtotime($pagoCliente->fecha_operacion))}}" readonly="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="fecha_operacion">Fecha Ingreso</label>
              <input type="text" class="form-control"                  
                  value="{{date('d/m/Y', strtotime($pagoCliente->fecha_reporte))}}" readonly="">
            </div>
          </div>          
        </div>
        <div class="form-group">
                    <label for="codigo_operacion">Codigo de operacion</label>
                    <input  type="text" class="form-control"
                            name="codigo_operacion" value="{{$pagoCliente->codigo_operacion}}"  readonly="">
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
                           value="{{$pagoCliente->monto_operacion}}" readonly="">
                </div>
                <div class="form-group">
                  <label for="banco">Banco</label>
                  <input  type="text" value="{{$pagoCliente->banco}}" class="form-control"
                           readonly="">
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
</div> <!-- /.row-top -->

