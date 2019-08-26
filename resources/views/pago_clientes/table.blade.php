<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de pagos de cliente</h2>
        <div class="pull-right">
          <a href="" class="btn btn-default">
            <i class="fa  fa-file-excel-o"></i>
            Exportar a Excel
          </a>
        </div>
      </div><!-- /.box-header -->
      <div class="box-body">
        @include('pago_clientes.opciones')
        <table id="tabla-pagos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha Operacion</th>
              <th>Nro Factura</th>
              <th>Cliente</th>
              <th>Abono</th>
              <th>Saldo</th>
              <th>Banco</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pagos as $pago)
              @foreach ($pago->pedidoClientes as $pedidoCliente)
              <tr>
                <td>{{$loop->parent->iteration}}</td>
                <td>{{date('d/m/Y', strtotime($pago->fecha_operacion))}}</td>
                <td>{{$pedidoCliente->nro_factura}}</td>
                <td>{{$pedidoCliente->cliente->razon_social}}</td>
                <td>S/&nbsp;{{$pago->monto_operacion}}</td>
                <td>S/&nbsp;{{$pago->saldo}}</td>
                <td>{{$pago->banco}}</td>
              </tr>
              @endforeach
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="box-footer">
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->