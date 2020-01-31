<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de Pedidos</h2>
        <div class="pull-right">
          <a href="{{route('pedido_clientes.create')}}" class="btn btn-success">
            <i class="fa fa-plus"></i>
            Nuevo pedido
          </a>
        </div>
      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group pull-right">
              <button id="btn-pagar" data-toggle="modal" data-target="#modal-create-pago_bloque" class="btn btn-success" >
                <i class="fa fa-money"> </i>
                Pagar en Bloque
              </button>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row filtrado">
                <div class="col-md-6">
                  <div class="form-inline">
                      <label for="fecha_inicio">FECHA: </label>
                      <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control"
                        name="fecha_inicio" placeholder="Fecha descarga">
                    </div>
                </div>
                <div class="col-md-6 pull-right" >
                    <button id="filtrar-fecha" class="btn btn-info">
                      <i class="fa fa-search"></i>
                      Filtrar
                    </button>      
                    <button id="clear-fecha" class="btn btn-danger">
                      <i class="fa fa-remove "></i>
                      Limpiar
                    </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        @include('pedido_clientes.partials.opciones')
        <table id="tabla-pedido_clientes" class="table table-bordered table-striped responsive display " style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>Fecha Descarga</th>
              <th>N° de Factura</th>
              <th>Cliente</th>
              <th>Hora Descarga</th>
              <th>Fecha Factura</th>
              <th>Cantidad Galones</th>
              <th>Monto Total (S/.)</th>              
              <th>Saldo (S/.)</th>      
              <th>Observación</th>       
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
           <tbody>
            @foreach ($pedido_clientes as $pedido_cliente)
              <tr>
                <td>{{$pedido_cliente->fecha_descarga}}</td>
                <td>
                  @if($pedido_cliente->factura_cliente_id)
                    {{$pedido_cliente->facturaCliente->nro_factura}}
                  @else
                  Sin Factura
                  @endif
                </td>
                <td>{{$pedido_cliente->cliente->razon_social}}</td>
                <td>{{$pedido_cliente->horario_descarga}}</td>
                <td>
                  @if($pedido_cliente->factura_cliente_id)
                    {{$pedido_cliente->facturaCliente->fecha_factura}}
                  @else
                  Sin Factura
                  @endif
                </td>
                <td>{{$pedido_cliente->galones}}</td>
                <td>{{$pedido_cliente->getPrecioTotal()}}</td>
                <td>{{$pedido_cliente->saldo}}</td>
                <td>{{$pedido_cliente->observacion}}</td>
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