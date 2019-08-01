<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de pagos de cliente</h2>
      </div><!-- /.box-header -->
      <div class="box-body">
        @include('pago_clientes.opciones')
        <table id="tabla-pedido_clientes" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha Operacion</th>
              <th>Nro Pedido</th>
              <th>Cliente</th>
              <th>Monto</th>
              <th>Saldo</th>
              <th>Banco</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pagos as $pago)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{date('d/m/Y', strtotime($pago->fecha_operacion))}}</td>
                <td>{{$pago->pedidoCliente->nro_pedido}}</td>
                <td>{{$pago->pedidoCliente->cliente->razon_social}}</td>
                <td>S/&nbsp;{{$pago->monto_operacion}}</td>
                <td>S/&nbsp;{{$pago->pedidoCliente->saldo}}</td>
                <td>{{$pago->banco}}</td>
                <td>Gaaaaaaaaaaa</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="box-footer">
        <a href="{{route('pedido_clientes.create')}}" class="btn btn-default">
          <i class="fa  fa-file-excel-o"></i>
          Exportar a Excel
        </a>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->