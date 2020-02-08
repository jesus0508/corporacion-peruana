<table id="distribucion" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
  <thead>
    <tr>
      <th>Transportista</th>
      <th>Grifo|Cliente</th>
      <th>Fecha Descarga</th>
      <th>Fecha Factura</th>
      <th>SCOP</th>
      <th>N° pedido</th> 
      <th>Planta</th>
      <th>Placa</th>
      <th>Galonaje (asignados)</th>
      <th>Precio Galón</th>
      <th>Monto Total</th>
      <th>Monto Facturado</th>
      <th>Factura</th>
      <th>Saldo</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($pedidos as $pedido)
      <?php $x = ''; ?>
      @foreach($pedido->pedidoProveedorGrifos as $grifo)
        <tr>
          <?php if(empty($x)){?>
          <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                count($pedido->pedidoProveedorClientes)}}">
            {{$pedido->vehiculo->transportista->nombre_transportista}}
          </td>
          <?php } ?>                      
          <td>  
            {{$grifo->grifo->razon_social}}
          </td>                  
          <td>{{$grifo->fecha_descarga}}</td>
          <?php if(empty($x)){?>
          <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                count($pedido->pedidoProveedorClientes)}}">                    
            @if($pedido->factura_proveedor_id)
              {{$pedido->facturaProveedor->fecha_factura_proveedor}}
            @endif
          </td>
          <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                count($pedido->pedidoProveedorClientes)}}"> 
            {{$pedido->scop}}</td>
          <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                count($pedido->pedidoProveedorClientes)}}"> 
            {{$pedido->nro_pedido}} </td>
          <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                count($pedido->pedidoProveedorClientes)}}"> 
            {{$pedido->planta->planta}}</td>
          <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                count($pedido->pedidoProveedorClientes)}}"> 
            {{$pedido->vehiculo->placa}}</td>
         <?php } ?>
          <td>{{$grifo->asignacion}}</td> 
          <?php if(empty($x)){?>
          <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                count($pedido->pedidoProveedorClientes)}}">
            {{$pedido->costo_galon}}
          </td>
          <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                count($pedido->pedidoProveedorClientes)}}">
            {{$pedido->getMonto()}}
          </td> 
          <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                count($pedido->pedidoProveedorClientes)}}">                    
            @if($pedido->factura_proveedor_id)
              {{$pedido->facturaProveedor->monto_factura}}
            @endif
          </td>
          <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                count($pedido->pedidoProveedorClientes)}}">                    
            @if($pedido->factura_proveedor_id)
              {{$pedido->facturaProveedor->nro_factura_proveedor}}
            @endif
          </td>
          <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                count($pedido->pedidoProveedorClientes)}}">                    
              {{$pedido->saldo}}
          </td>
           <?php } ?>
        </tr>
       <?php $x = $pedido->id; ?>
      @endforeach

      <?php $y = ''; ?>
      @foreach($pedido->pedidoProveedorClientes as $cliente)
        <tr>                    
          <td>{{$cliente->pedidoCliente->cliente->razon_social}}</td>                  
          <td>{{$cliente->pedidoCliente->fecha_descarga}}</td>
          <td>{{$grifo->asignacion}}</td> 
         </tr>
       <?php $y = $pedido->id; ?>
      @endforeach

    @endforeach
  </tbody>
</table>
