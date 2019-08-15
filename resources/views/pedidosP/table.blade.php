<section class="content">
  <h2>LISTA DE PEDIDOS</h2>
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Lista de COMPRAS A PROVEEDORES &nbsp; &nbsp; &nbsp;</h3>
            @php    
              $pagar = false;
            @endphp 

            @foreach( $pedidos as $pedido )
              @if( $pedido->estado == 2 )
                @php
                $pagar = true;
                @endphp
             
              @endif

            @endforeach

            @if( $pagar == true)
            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modal-pagar-proveedor">
               PAGAR   &nbsp;&nbsp; <span class="fa fa-money"></span>
            </button>
            @endif           

        </div>
        <!-- /.box-header -s-->
        <div class="box-body">
          <table id="proveedores" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nro pedido</th>
                <th>Planta</th>
                <th>SCOP</th>
                <th>Fecha pedido</th>
                <th>GLS</th>
                <th>Precio galon/u</th> 
                <th>Monto</th>
                <th>Saldo</th>
                <th>Estado</th>
                <th>Acciones</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($pedidos as $pedido)

                <tr>
                  <td>{{$pedido->nro_pedido}}</td>
                  <td>{{$pedido->planta->planta}}</td>
                  <td>{{$pedido->scop}}</td>
                  <td>{{$pedido->created_at}}</td>
                  <td>{{$pedido->galones}}</td>
                  <td>S/&nbsp;{{$pedido->costo_galon}}</td>
                  <td>S/&nbsp;{{number_format((float)
                    $pedido->galones*$pedido->costo_galon, 2, '.', '') }}</td>
                    <td>
                    @if($pedido->saldo == null)
                    S/&nbsp;{{number_format((float)
                    $pedido->galones*$pedido->costo_galon, 2, '.', '')}}
                    @else
                    S/&nbsp;{{$pedido->saldo  }}
                    @endif                      
                    </td>
                 
                  @includeWhen($pedido->isConfirmed(), 'actions.pedido.acciones_confirmado')
                  @includeWhen($pedido->isUnconfirmed(),'actions.pedido.acciones_sin_confirmar')
                  @includeWhen($pedido->isDistributed(), 'actions.pedido.acciones_distrubuido') 
                  @includeWhen($pedido->isPaid(), 'actions.pedido.acciones_pagado')             

                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->

  @include('pedidosP.edit')
  @include('pago_proveedores.modal')
</section>
