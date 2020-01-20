<section class="content">
  <h3>LISTA DE PEDIDOS PAGADOS </h3>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Lista de COMPRAS a &nbsp; &nbsp; &nbsp;<span class="label label-primary">{{$proveedor->razon_social}}</span></h3>           
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="table-pago_proveedor-resumen" class="table table-striped
            table-bordered display nowrap">
            <thead>
              <tr>
              {{-- //pago proveedor --}}
                <th>Fecha Operacion</th>
                <th>Fecha Egreso</th>
                <th>Número de operación</th>
                <th>Monto pago</th>
                <th>Banco</th>

                <th>Nro pedido</th>
                <th>Planta</th>
                <th>SCOP</th>
                <th>Cantidad GLS</th>
                <th>Precio galon/u</th>
                <th>Monto</th>
                <th>Monto Facturado</th>
                <th>Monto Pagado(S/.)</th> {{-- 12 --}}
                <th>Saldo Actual</th>
                <th>Estado</th>
                <th>Factura - Estado</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pedidos as $pedido)
                @if( $pedido != null )
                <tr>
                  {{-- //pago proveedor --}}
                  <td>{{date('d/m/Y', strtotime($pago_proveedor->fecha_operacion))}}</td>
                  <td>{{date('d/m/Y', strtotime($pago_proveedor->fecha_reporte))}}</td>
                  <td>{{$pago_proveedor->codigo_operacion}}</td>
                  <td>{{$pago_proveedor->monto_operacion}}</td>
                  <td>{{$pago_proveedor->banco}}</td>

                  <td>{{$pedido->nro_pedido}}</td>
                  <td>{{$pedido->planta->planta}}</td>
                  <td>{{$pedido->scop}}</td>
                  <td>{{$pedido->galones}}</td>
                  <td>S/&nbsp;{{$pedido->costo_galon}}</td>
                  <td>{{$pedido->getMonto()}}</td>
                  <td>@if($pedido->factura_proveedor_id)
                    S/&nbsp;{{$pedido->facturaProveedor->monto_factura}}                  
                    @endif      
                  </td>
                   <td>{{$pedido->asignacion }}</td>
                  <td>
                    S/&nbsp;{{$pedido->saldo  }}
                  </td>
                  <td>
                   <?php
                    if($pedido->factura_proveedor_id){
                     if( $pedido->saldo != $pedido->facturaProveedor->monto_factura ){
                         
                        echo '<div class = "progress-bar progress-bar-success progress-bar-stripped active" role = "progressbar" aria-valuenow = "60" aria-valuemin = "0" aria-valuemax = "100" style = "width:' .($pedido->facturaProveedor->monto_factura-$pedido->saldo)*100/$pedido->facturaProveedor->monto_factura . '%;">'.'<label style="font-size: 11px!important; color:black!important" class = "" >'.number_format((float)($pedido->facturaProveedor->monto_factura-$pedido->saldo)*100/$pedido->facturaProveedor->monto_factura,0,'.', '').' % </label>';
                      } else{
                        echo '<label class="label label-default">'.($pedido->facturaProveedor->monto_factura-$pedido->saldo).'/'.$pedido->facturaProveedor->monto_factura.' SOLES </label>';
                     }
                    } else {
                      if( $pedido->saldo != $pedido->getMonto() ){
                         
                        echo '<div class = "progress-bar progress-bar-success progress-bar-stripped active" role = "progressbar" aria-valuenow = "60" aria-valuemin = "0" aria-valuemax = "100" style = "width:' .($pedido->getMonto()-$pedido->saldo)*100/$pedido->getMonto() . '%;">'.'<label style="font-size: 11px!important; color:black!important" class = "" >'.number_format((float)($pedido->getMonto()-$pedido->saldo)*100/$pedido->getMonto() ,0,'.', '').' % </label>';
                      } else{
                        echo '<label class="label label-default">'.($pedido->asignacion).'/'.$pedido->getMonto().' SOLES </label>';
                     }
                    }
                   ?>
                  </td> 
                  <td>
                    @if($pedido->factura_proveedor_id)
                    Factura {{$pedido->facturaProveedor->nro_factura_proveedor}}&nbsp; - &nbsp;@if($pedido->saldo == 0) CANCELADO @else AMORTIZADO @endif
                    @else
                    Sin factura
                    @endif
                  </td>     
                </tr>
               @endif
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th colspan="12" style="text-align: right;">
                  MONTO TOTAL
                </th>
                <th></th>
                <th colspan="3"></th>                
              </tr>
            </tfoot>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
  @include('pago_proveedores.modal')
</section>
