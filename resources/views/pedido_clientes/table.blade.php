<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de Pedidos</h2>
        <div class="pull-right">
          <a href="{{route('pedido_clientes.create')}}" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            Nuevo pedido
          </a>
          <a href="{{route('pedido_clientes.create')}}" class="btn btn-default">
            <i class="fa  fa-file-excel-o"></i>
            Exportar a Excel
          </a>
        </div>
      </div><!-- /.box-header -->
      <div class="box-body">
        @include('pedido_clientes.partials.opciones')
        <table id="tabla-pedido_clientes" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>Fecha de Pedido</th>
              <th>Cliente</th>
              <th>Cantidad GLS</th>
              <th>Monto Total</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
           <tbody>
            @foreach ($pedido_clientes as $pedido_cliente)
              <tr>
                <td>{{date('d/m/Y', strtotime($pedido_cliente->created_at))}}</td>
                <td>{{$pedido_cliente->cliente->razon_social}}</td>
                <td>{{$pedido_cliente->galones}}</td>
                <td>S/&nbsp;{{$pedido_cliente->getPrecioTotal()}}</td>
                @includeWhen($pedido_cliente->isUnconfirmed(), 'pedido_clientes.partials.acciones_sin_confirmar')
                @includeWhen($pedido_cliente->isConfirmed(), 'pedido_clientes.partials.acciones_confirmado')
                @includeWhen($pedido_cliente->isDistributed(), 'pedido_clientes.partials.acciones_distribuido')
                @includeWhen($pedido_cliente->isAmortized(), 'pedido_clientes.partials.acciones_amortizado')
                @includeWhen($pedido_cliente->isPaid(), 'pedido_clientes.partials.acciones_pagado')
              </tr>
            @endforeach
          </tbody> 
        </table>
      </div>
      <div class="box-footer">

      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->