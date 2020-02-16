<section class="content">
  <h3>LISTA DE PEDIDOS PAGADOS </h3>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Lista de pedidos pagados - &nbsp; &nbsp; &nbsp;<span class="label label-primary">{{$cliente}}</span></h3>           
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="table-pago_cliente-resumen" class="table table-striped
            table-bordered display " width="100%">
            <thead>
              <tr>
                <th>Cantidad galones pedido</th>
                <th>Precio galon/u</th>
                <th>Monto Total Pedido</th>
                <th>Monto Pagado(S/.)</th> {{-- 8 --}}
                <th>Saldo Actual</th>
                <th>Estado</th>
                <th>Factura - Estado</th>

                  {{-- //pago proveedor --}}
                <th>Fecha Operacion</th>
                <th>Fecha Ingreso</th>
                <th>Número de operación</th>
                <th>Monto pago</th>
                <th>Banco</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pedidos as $pedido)
                @if( $pedido != null )
                <tr>
                  <td>{{$pedido->galones}}</td>
                  <td>S/&nbsp;{{$pedido->precio_galon}}</td>
                  <td>{{$pedido->getPrecioTotal()}}</td>
                  <td>{{$pedido->monto_asignado }}</td>
                  <td>
                    S/&nbsp;{{$pedido->saldo  }}
                  </td>
                  <td>
                   <?php
                        echo '<div class = "progress-bar progress-bar-success progress-bar-stripped active" role = "progressbar" aria-valuenow = "60" aria-valuemin = "0" aria-valuemax = "100" style = "width:' .($pedido->getPrecioTotal()-$pedido->saldo)*100/$pedido->getPrecioTotal() . '%;">'.'<label style="font-size: 11px!important; color:black!important" class = "" >'.number_format((float)($pedido->getPrecioTotal()-$pedido->saldo)*100/$pedido->getPrecioTotal(),0,'.', '').' % </label>';
                   ?>
                  </td> 
                  <td>
                    @if($pedido->factura_cliente_id)
                    Factura {{$pedido->facturaCliente->nro_factura}}&nbsp; - &nbsp;@if($pedido->saldo == 0) CANCELADO @else AMORTIZADO @endif
                    @else
                    Sin factura
                    @endif
                  </td>

                  {{-- //pago proveedor --}}
                  <td>{{date('d/m/Y', strtotime($pagoCliente->fecha_operacion))}}</td>
                  <td>{{date('d/m/Y', strtotime($pagoCliente->fecha_reporte))}}</td>
                  <td>{{$pagoCliente->codigo_operacion}}</td>
                  <td>{{$pagoCliente->monto_operacion}}</td>
                  <td>{{$pagoCliente->banco}}</td>   

                </tr>
               @endif
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th colspan="3" style="text-align: right;">
                  MONTO PAGO TOTAL
                </th>
                <th></th>
                <th colspan="7"></th>                
              </tr>
            </tfoot>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
  @include('pago_proveedores.modal')
</section>
