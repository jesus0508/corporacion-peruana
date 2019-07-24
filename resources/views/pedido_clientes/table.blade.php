<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de pedidos - Table</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="tabla-pedido_clientes" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nro Pedido</th>
                <th>Fecha de Pedido</th>
                <th>SCOP</th>
                <th>Grifo</th>
                <th>Planta</th>
                <th>Horario</th>
                <th>Cantidad GLS</th>
                <th>Monto Total</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pedido_clientes as $pedido_cliente)
                <tr>
                  <td>{{$pedido_cliente->nro_pedido}}</td>
                  <td>{{date('d/m/Y', strtotime($pedido_cliente->created_at))}}</td>
                  <td>{{$pedido_cliente->scop}}</td>
                  <td>{{$pedido_cliente->grifo}}</td>
                  <td>{{$pedido_cliente->planta}}</td>
                  <td>{{$pedido_cliente->horario_descarga}}</td>
                  <td>{{$pedido_cliente->galones}}</td>
                  <td>S/&nbsp;{{$pedido_cliente->getPrecioTotal()}}</td>
                  @includeWhen($pedido_cliente->isConfirmed(), 'pedido_clientes.partials.acciones_confirmado')
                  @includeWhen(!$pedido_cliente->isConfirmed(), 'pedido_clientes.partials.acciones_sin_confirmar')
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->