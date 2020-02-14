<table id="tabla-resumen" class="table table-bordered table-striped "
 style="width:100%" cellspacing="0" border-style: solid>
  <thead>
    <tr>
      <th colspan="8">PAGO A TRANSPORTISTAS - REPORTE</th>
    </tr>
  </thead>
  <tbody>
  	<tr> {{-- first row --}}
  		<td colspan="2">Fecha</td>
  		<td colspan="2">Monto Descontado</td>
  		<td colspan="2">Total Faltantes</td>
  		<td>	Dscto Pendiente (anterior)</td>
  		<td>{{$transportista->descuento_pendiente-$pago_transportista->pendiente_dejado}}</td>  
  	</tr> 
  	<tr> {{-- second row --}}
  		<td colspan="2">{{$pago_transportista->fecha_pago}}</td>
  		<td colspan="2">{{$desc - $pago_transportista->pendiente_dejado}}</td>
  		<td colspan="2">{{number_format((float)$desc, 2, '.', '')}}</td>
  		<td>Subtotal</td>
  		<td>{{$subtotal}}</td>
  	</tr>
  	<tr> {{-- third row --}}
  		<td colspan="4">Observación</td>
  		<td colspan="2">Monto Dejado como pendiente </td>
  		<td>	Dscto por faltantes actuales </td>
  		<td>{{$transportista->descuento_pendiente-$pago_transportista->pendiente_dejado}}</td>  
  	</tr> 
  	<tr> {{-- fourth row --}}
  		<td colspan="4">{{$pago_transportista->observacion}}</td>
  		<td colspan="2">{{$pago_transportista->pendiente_dejado}}</td>
  		<td>	TOTAL PAGADO </td>
  		<td>{{$transportista->descuento_pendiente-$pago_transportista->pendiente_dejado}}</td>  
  	</tr> 

  	{{-- Fletes --}}
  	<tr>
	    <td>FLETERO</td> todo el pedido
	    <td>GRIFO</td>
	    <td>F Descarga</td>
	    <td>SCOP</td>todo el pedido
	    <td>N de PEDIDO</td>todo el pedido
	    <td>PLANTA</td>todo el pedido
	    <td>GLS</td>todo el pedido
	    <td>Monto</td>todo el pedido
  	</tr>
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
              <a href="{{route('pedidos.ver_distribucion', $pedido->id)}}">
                {{$pedido->scop}} </a>
            </td>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}"> 
              {{$pedido->nro_pedido}} </td>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}"> 
              {{$pedido->planta->planta}}</td>
           <?php } ?>
            <td>{{$grifo->asignacion}}</td> 
            <?php if(empty($x)){?>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}">
              {{$pedido->costo_flete}}
            </td> 
             <?php } ?>
          </tr>
          <?php $x = $pedido->id; ?>
        @endforeach

        @if(count($pedido->pedidoProveedorGrifos)>0)
          <?php $y = ''; ?>
          @foreach($pedido->pedidoProveedorClientes as $cliente)
            <tr>                    
              <td>{{$cliente->pedidoCliente->cliente->razon_social}}</td>                  
              <td>{{$cliente->pedidoCliente->fecha_descarga}}</td>
              <td>{{$cliente->asignacion}}</td> 
             </tr>
           <?php $y = $pedido->id; ?>
          @endforeach
        @else
          @foreach($pedido->pedidoProveedorClientes as $cliente)
          <tr>
            <?php if(empty($y)){?>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}">
              {{$pedido->vehiculo->transportista->nombre_transportista}}
            </td>
            <?php } ?>                      
            <td>{{$cliente->pedidoCliente->cliente->razon_social}}</td>                  
            <td>{{$cliente->pedidoCliente->fecha_descarga}}</td>
            <?php if(empty($y)){?>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}"> 
              <a href="{{route('pedidos.ver_distribucion', $pedido->id)}}">
                {{$pedido->scop}} </a>
            </td>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}"> 
              {{$pedido->nro_pedido}} </td>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}"> 
              {{$pedido->planta->planta}}</td>
           <?php } ?>
            <td>{{$cliente->asignacion}}</td> 
            <?php if(empty($y)){?>

            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}">
              {{$pedido->costo_flete}}
            </td> 
             <?php } ?>
          </tr>
          <?php $y = $pedido->id; ?>
          @endforeach
        @endif
      @endforeach
      
      <tr>                
        <td colspan="7">SUBTOTAL</td>
        <td>S/. &nbsp; {{$subtotal}}</td>
      </tr>

      {{-- Faltantes --}}

	  <tr>
	    <th>Descripcion</th>
	    <th>Fecha Descarga</th>
	    <th>GRIFO</th>
	    <th>Planta</th> 
	    <th>Grifero</th>
	    <th>Faltante gls</th>
	    <th>Precio</th>
	    <th>Monto Desc</th>
	  </tr>
 		@foreach ($lista_descuento as $pedido_cliente)
      <tr>
        <td>{{$pedido_cliente->descripcion}}</td>
        <td>  
          @if( $pedido_cliente->fecha_descarga )
          {{date('d/m/Y', strtotime($pedido_cliente->fecha_descarga))}}
          @else
          No acordado
          @endif
        </td>
        <td>{{$pedido_cliente->razon_social}}</td>             
        <td>{{$pedido_cliente->planta}}</td> 
        <td>{{$pedido_cliente->grifero}}</td>
        <td>{{$pedido_cliente->faltante}}</td>
        <td>{{$pedido_cliente->costo_galon}}</td>
        <td>
            S/&nbsp;    {{number_format((float)
                $pedido_cliente->faltante * $pedido_cliente->costo_galon, 2, '.', '') }}              
        </td>
      </tr>
      <tr>      	         
        <td colspan="7">TOTAL FALTANTES</td>
        <td>S/. &nbsp; {{$desc}}</td>
      </tr>
    @endforeach
  </tbody> 
</table>