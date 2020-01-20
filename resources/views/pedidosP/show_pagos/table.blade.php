<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header">

          <h3 class="box-title pull-left">Lista de PAGOS A 
            <a href="{{route('pedidos.show',$pedido->id)}}">Pedido</a> &nbsp; &nbsp; &nbsp;
          </h3>
   
        </div>
        <!-- /.box-header -s-->
        <div class="box-body">
          <table id="resumen-historial-pago-pedido" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>Fecha Egreso</th>
                <th>Fecha de Operacion</th>
                <th>Número de Operacion</th>
                <th>Monto de Operacion</th>
                <th>Banco</th> 
                <th>Monto Asignado </th>
                <th>Acciones</th>

              </tr>
            </thead>
            <tbody>
              @if(isset($pagos))
                @foreach ($pagos as $pago)
                  <tr>
                    <td>{{$pago->fecha_reporte}}</td>
                    <td>{{$pago->fecha_operacion}}</td>                  
                    <td>{{$pago->codigo_operacion}}</td>
                    <td>{{$pago->monto_operacion}}</td>
                    <td>{{$pago->banco}}</td>
                    <td>{{$pago->asignacion}}</td> 
                    <td><a href="{{ route('pago_proveedors.resumen_pago', $pago->id)}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i>&nbsp;&nbsp;Ver Operación</a></td>      
                  </tr>
                @endforeach
              @endif
                  <tr>
                    <td><b>Pedido Extraordinario(SCOP)</b></td>
                    <td><b>Nro pedido</b></td>
                    <td><b>Monto</b></td>
                    <td><b>Monto Facturado</b></td>
                    <td><b>Nro Factura</b></td>
                    <td></td> 
                    <td><b>Acciones</b></td>
                  </tr>
                  @foreach($extraordinario_pedidos as $pedido)
                    <tr>
                      <td>{{$pedido->scop}}</td>
                      <td>{{$pedido->nro_pedido}}</td>                      
                      <td>{{$pedido->getMonto()}}</td>
                      <td>
                        @if($pedido->factura_proveedor_id)
                        {{$pedido->facturaProveedor->monto_factura}}
                        @else
                        Sin factura
                        @endif
                      </td>
                      <td>
                        @if($pedido->factura_proveedor_id)
                        {{$pedido->facturaProveedor->nro_factura_proveedor}}
                        @else
                        Sin factura
                        @endif
                      </td>
                      <td>{{$pedido->asignacion}}</td>
                      <td><a href="{{route('pago_proveedors.edit', $pedido->id)}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i>&nbsp;&nbsp;Ver Pedido</a></td>
                    </tr>
                  @endforeach 
            </tbody>
            <tfoot>
              <tr>
                <th colspan="5" style="text-align: right;">TOTAL PAGADO</th>
                <th></th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
</section>
