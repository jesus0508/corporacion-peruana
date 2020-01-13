<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Distribución a Clientes y Grifos</h2>
        
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-pedido-clientes-grifos-asignacion" class="table table-bordered table-striped display nowrap"
         style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>RUC</th>
              <th>Nombre Cliente</th>
              <th>Fecha Descarga</th>
              <th>Hora Descarga</th>
              <th>Monto</th>
              <th>Precio Galon</th>
              <th>Galones Pedidos</th>
              <th>Galones Asignados</th>
              <th>Acción </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pedidos_cl as $pedido_cliente)
              <tr>
                <td>{{$pedido_cliente->cliente->ruc}}</td>
                <td>{{$pedido_cliente->cliente->razon_social}}</td>
                <td>{{$pedido_cliente->fecha_descarga}}</td>
                <td>{{$pedido_cliente->horario_descarga}}</td>
                <td>{{round($pedido_cliente->getPrecioTotal(),2)}}</td>
                <td>{{$pedido_cliente->precio_galon}}</td>
                <td>{{$pedido_cliente->galones}}</td>
                <td>{{$pedido_cliente->asignacion}}</td>
                <td><a class="btn btn-primary btn-sm" 
                  href="{{route('pedido_clientes.detalles',$pedido_cliente->id)}}">
                    <span class="glyphicon glyphicon-eye-open">                      
                    </span></a></td>

              </tr>
            @endforeach
            @if(count($pedidos_grifos)>0)
              <tr>
                <td><b>RUC </b></td>
                <td><b>Nombre GRIFO</b></td>
                <td><b>Fecha Descarga </b></td>
                <td><b>Hora Descarga</b></td>             
                <td><b>Zona</b></td>
                <td><b>Stock anterior</b></td>
                <td><b>Stock Actualizado </b></td>
                <td></td>
                <td></td>
              </tr>
              @foreach ($pedidos_grifos as $pedidos_grifo)
                <tr>
                  <td> {{$pedidos_grifo->ruc}}</td>
                  <td>{{$pedidos_grifo->razon_social}}</td>

                  <td>
                    @if($pedidos_grifo->fecha_descarga)
                    {{date('d/m/Y', strtotime($pedidos_grifo->fecha_descarga))}}                  
                    @endif
                  </td>
                  <td>{{$pedidos_grifo->hora_descarga}}</td>
                  <td>{{$pedidos_grifo->zona}}</td>
                  <td>{{$pedidos_grifo->stock-$pedidos_grifo->asignacion}}&nbsp;galones</td>
                  <td><b>{{$pedidos_grifo->stock}}</b> &nbsp;galones</td>
                  <td> {{$pedidos_grifo->asignacion}}</td>
                  <td></td>
                </tr>
              @endforeach
            @endif
          </tbody>
          <tfoot>
            <tr>
                <th colspan="7" style="text-align:right">Total Galones Distribuidos</th>
                <th></th> <!-- saldo -->
                <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->