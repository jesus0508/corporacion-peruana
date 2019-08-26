<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header">

          <h3 class="box-title pull-left">Lista de COMPRAS A 
            <a href="{{route('proveedores.index')}}">PROVEEDORES</a> &nbsp; &nbsp; &nbsp;
          </h3>
            <div class="pull-right">
              <a href="{{ route('pedidos.create') }}">
              <button class="btn bg-olive">
               <span class="fa fa-plus"></span> &nbsp;Nuevo Pedido Proveedor
              </button>
              </a>
              <a href="{{route('factura_proveedor.create')}}">
                <button class="btn bg-purple">
                Registrar Factura &nbsp;   <i class="fa fa-share-square-o"></i>
                </button>
              </a>  
              <a href="#">
                <button class="btn btn-default">
                  <span class="fa fa-file-excel-o"></span> &nbsp;Exportar a Excel 
                </button>
              </a>
            </div>   
        </div>
        <!-- /.box-header -s-->
        <div class="box-body">
             @include('pedidosP.partials.opciones')
          <table id="proveedores" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nro pedido</th>
                <th>SCOP</th>
                <th>Planta</th>
                <!-- <th>Fecha pedido</th> -->
                <th>GLS</th>
                <th>Precio galon/u</th> 
                <th>Monto (S/.)</th>
                <th>M.Facturado (S/.) </th>
                <th>Saldo</th>
                <th>Estado</th>
                <th>Acciones</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($pedidos as $pedido)

                <tr>
                  <td>{{$pedido->nro_pedido}}</td>
                  <td>{{$pedido->scop}}</td>                  
                  <td>{{$pedido->planta->planta}}</td>
                  <!-- <td>{{$pedido->created_at}}</td> -->
                  <td>{{$pedido->galones}}</td>
                  <td>{{$pedido->costo_galon}}</td>

                  <td>{{number_format((float)
                    $pedido->getPrecioTotal(), 2, '.', '') }}</td>
                  <td>
                    @if($pedido->saldo == null)
                    0.00
                    @else
                    {{number_format((float)
                    $pedido->facturaProveedor->monto_factura, 2, '.', '') }}

                    @endif 
                  </td>
                  <td> S/&nbsp; 
                    @if($pedido->saldo == null)
                    0.00
                    @else
                    {{$pedido->saldo}}
                    @endif                      
                  </td>
                 
                  @includeWhen($pedido->isConfirmed(), 'actions.pedido.acciones_confirmado')
                  @includeWhen($pedido->isUnconfirmed(),'actions.pedido.acciones_sin_confirmar')
                  @includeWhen($pedido->isDistributed(), 'actions.pedido.acciones_distribuido') 
                  @includeWhen($pedido->isPaid(), 'actions.pedido.acciones_pagado')             

                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
</section>
