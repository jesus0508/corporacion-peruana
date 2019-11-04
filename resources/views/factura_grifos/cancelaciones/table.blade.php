<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Lista últimas 100 cancelaciones</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-cancelaciones" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha Fact</th>
              <th>Grifo</th>
              <th>Fecha Depósito </th>
              <th>Número de Operacion Depósito</th>
              <th>Monto Depósito</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cancelaciones as $cancelacion)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$cancelacion->facturacionGrifo->fecha_facturacion}}</td>
                <td>{{$cancelacion->facturacionGrifo->grifo->razon_social}}</td>
                <td>{{$cancelacion->fecha}}</td>
                <td>{{$cancelacion->nro_operacion}}</td>
                <td>{{$cancelacion->monto}}</td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
                <th colspan="5" style="text-align:right">Total Factura</th>
                <th></th> <!-- saldo -->
            </tr>
          </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->