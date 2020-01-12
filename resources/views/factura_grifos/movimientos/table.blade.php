<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de movimientos</h2>
        <div class="pull-right">
          <button id="btn-registrar_movimiento" data-toggle="modal" data-target="#modal-create-movimiento" class="btn btn-primary" >
            <i class="fa fa-plus"> </i>
            Registrar movimiento
          </button>
          <a href="{{route('movimiento_grifos.verificar')}}" id="" class="btn btn-success" >
            <i class="fa fa-check"> </i>
            Verificar movimientos
          </a>
        </div>
      </div><!-- /.box-header -->
      <div class="box-body">
        @include('factura_grifos.movimientos.opciones')
        <table id="tabla-movimiento-grifos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>Fecha Ingreso</th>
              <th>Fecha Operacion</th>
              <th>Grifo</th>
              <th>Codigo Operacion</th>
              <th>Abono</th>
              <th>Banco</th>
              <th>Estado</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="box-footer">
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->