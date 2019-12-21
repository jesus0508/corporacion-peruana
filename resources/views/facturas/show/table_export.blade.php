<div class="row" id="div-tabla-export-factura">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header">
          boton show or hide
          {{-- <p>{{$pedido}}</p> --}}
          <p>asedas{{$pedido->vehiculo}}</p>
      </div>
      <div class="box-body">
          <table id="factura-export" class="table table-bordered table-striped responsive">
            <thead>
              <tr id="header_table">
                <th>Nro pedido</th>
                <th>SCOP</th>
                <th>Planta</th>
                <th>GLS</th>
      <!-- 4 --><th>Precio galon/u</th> 
                <th>Monto</th>
                <th>Nro de Factura</th>
   <!-- 6-->    <th>M.Facturado</th>
<!--  7 -->     <th>Fecha Factura</th>
                <th>Saldo</th>

              </tr>
            </thead>
            <tbody>
                <tr>
                  <td>{{$pedido->nro_pedido}}</td>
                  <td>{{$pedido->scop}}</td>                  
                  <td>{{$pedido->planta->planta}}</td>
                  <td>{{$pedido->galones}}</td>
                  <td>{{$pedido->costo_galon}}</td>
                  <td>{{$pedido->getMonto()}} </td>
                @if( $pedido->facturaProveedor  )     
                  <td>{{$pedido->facturaProveedor->nro_factura_proveedor}}</td>                              
                  <td>{{$pedido->facturaProveedor->monto_factura}}</td>
                  <td>{{date( 'd/m/Y', 
                    strtotime($pedido->facturaProveedor->fecha_factura_proveedor) )}}</td>                
                @else
                  <td>-</td>
                  <td>0.00</td>
                  <td></td>
                @endif
                  <td>
                    {{$pedido->saldo}}                     
                  </td>                          
                </tr>
            </tbody>
          </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->








