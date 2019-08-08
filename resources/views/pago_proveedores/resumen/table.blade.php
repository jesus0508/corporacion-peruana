<section class="content">
  <h2>LISTA DE PEDIDOS CONFIRMADOS SIN PAGAR O PAGO PARCIAL</h2>
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Lista de COMPRAS A PROVEEDORES &nbsp; &nbsp; &nbsp;<span class="label label-primary">{{$proveedor->razon_social}}</span></h3>

            
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="proveedores" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nro pedido</th>
                <th>Planta</th>
                <th>SCOP</th>
           <!--     <th>Fecha pedido</th>-->
                <th>Cantidad GLS</th>
            <!--    <th>Precio galon/u</th> -->
                <th>Monto</th>
                <th>Monto Factura</th>
                <th>Saldo</th>
                <th>Estado</th>





              </tr>
            </thead>
            <tbody>
              @foreach ($pedidos as $pedido)
                @if( $pedido != null )


                <tr>
                  <td>{{$pedido->nro_pedido}}</td>
                  <td>{{$pedido->planta->planta}}</td>
                  <td>{{$pedido->scop}}</td>
            <!--      <td>{{date('d/m/Y', strtotime($pedido->fecha_despacho))}}</td> -->
                  <td>{{$pedido->galones}}</td>
             <!--     <td>S/&nbsp;{{$pedido->costo_galon}}</td> -->
                  <td>S/&nbsp;{{number_format((float)
                    $pedido->galones*$pedido->costo_galon, 2, '.', '') }}</td>
                  <td>
                    S/&nbsp;{{$pedido->facturaProveedor->monto_factura}}                  
                  </td>
                  <td>
                    S/&nbsp;{{$pedido->saldo  }}
                  
                  </td>
                  <td>
                   <?php 
                   if( $pedido->saldo != $pedido->facturaProveedor->monto_factura ){
                       
                       echo '<div class = "progress-bar progress-bar-success progress-bar-stripped active" role = "progressbar" aria-valuenow = "60" aria-valuemin = "0" aria-valuemax = "100" style = "width:' .($pedido->facturaProveedor->monto_factura-$pedido->saldo)*100/$pedido->facturaProveedor->monto_factura . '%;">'.'<label style="font-size: 11px!important; color:black!important" class = "" >'.number_format((float)($pedido->facturaProveedor->monto_factura-$pedido->saldo)*100/$pedido->facturaProveedor->monto_factura,0,'.', '').' % </label>';
                   } else{
                    echo '<label class="label label-default">'.($pedido->facturaProveedor->monto_factura-$pedido->saldo).'/'.$pedido->facturaProveedor->monto_factura.' SOLES </label>';
                   }
                   ?>
                  </td>
      

                </tr>
               @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
  @include('pago_proveedores.modal')
</section>
