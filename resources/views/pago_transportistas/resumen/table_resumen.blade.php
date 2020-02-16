<table id="tabla-resumen" class="table table-bordered table-striped "
 style="width:100%; " cellspacing="0" display="none" >
  <thead>
    <tr>
      <th colspan="8" style="text-align: center;">
       <center> PAGO A TRANSPORTISTA {{$transportista->nombre_transportista}} - REPORTE</center> 
      </th>
    </tr>
  </thead>
  <tbody>
  	<tr> {{-- first row --}}
  		<td style=" border: 1px solid black!important; text-align: center;"><b>Fecha</b> </td>
  		<td style=" border: 1px solid black!important; text-align: center;"><b> Monto Descontado</b></td>
  		<td colspan="1" style=" border: 1px solid black!important;"><b>Total Faltantes</b> </td>
      <td></td>
      <td></td>
      <td style="border-right: 1px solid black!important;"></td>
  		<td   style="background-color: #CACBCA; 
       text-align: center;
        border: 1px solid black!important;"><b>Dscto Pendiente (anterior)</b>	</td>
  		<td style="border: 1px solid black!important;">{{$transportista->descuento_pendiente-$pago_transportista->pendiente_dejado}}</td>  
  	</tr> 
  	<tr> {{-- second row --}}
  		<td colspan="1" style=" border: 1px solid black!important;text-align: center;">{{$pago_transportista->fecha_pago}}</td>
  		<td colspan="1" style=" border: 1px solid black!important;text-align: center;">{{$desc - $pago_transportista->pendiente_dejado}}</td>
  		<td colspan="1" style=" border: 1px solid black!important;text-align: center;">{{number_format((float)$desc, 2, '.', '')}}</td>
      <td></td>
      <td></td>
  		<td style="border-right: 1px solid black!important;"></td>
      <td   style="background-color: #CACBCA; 
       text-align: center;
        border: 1px solid black!important;"><b>Subtotal Fletes</b> </td>
  		<td style="border: 1px solid black!important;">{{$subtotal}}</td>
  	</tr>
  	<tr style=" text-align: center;"> {{-- third row --}}
  		<td colspan="2" style=" border: 1px solid black!important;text-align: center;" >
        <b>Observación</b>   
      </td>      
  		<td colspan="1" style=" border: 1px solid black!important;text-align: center;">
        <b>Monto Dejado como pendiente </b> 
      </td>
      <td></td>
      <td></td>
      <td style="border-right: 1px solid black!important;"></td>
  		<td   style="background-color: #CACBCA; 
       text-align: center;
        border: 1px solid black!important;"><b>Dscto por faltantes actuales</b>	 </td>
  		<td style="border: 1px solid black!important;">{{$desc - $pago_transportista->pendiente_dejado}}</td>  
  	</tr> 
  	<tr> {{-- fourth row --}}
  		<td colspan="2" style=" border: 1px solid black!important;text-align: center;">
        {{$pago_transportista->observacion}}
      </td>
  		<td colspan="1" style=" border: 1px solid black!important;text-align: center;">
        {{$desc - $pago_transportista->pendiente_dejado}}
      </td>
      <td></td>
      <td></td>
  		<td style="border-right: 1px solid black!important;"></td>
      <td style="background-color: #CACBCA; 
       text-align: center;
        border: 1px solid black!important;"> <b>TOTAL PAGADO</b>	 </td>
  		<td style="border: 1px solid black!important; color: #C93827; 
        background-color: #E4968D; font-weight: bold; font-size: large;">
        {{$pago_transportista->monto_total_pago}}
      </td>  
  	</tr> 
    <tr>
      <td colspan="8"></td>
    </tr>
    <tr>
      <td colspan="8"></td>
    </tr>
  	{{-- Fletes --}}
    <tr>
      <td colspan="8" style="font-weight: bold; text-align: center;">
        <center> <b>Fletes - Sr {{$transportista->nombre_transportista}}</b></center>      
      </td>
    </tr>
  	<tr>
	    <td  style="border: 1px solid black!important; font-weight: bold; text-align: center;">  FLETERO
      </td> 
	    <td style="border: 1px solid black!important; font-weight: bold; text-align: center;"> 
        GRIFO
      </td>
	    <td style="border: 1px solid black!important; font-weight: bold; text-align: center;"> 
        F Descarga
      </td>
      <td style="border: 1px solid black!important; font-weight: bold; text-align: center;"> 
        SCOP
      </td>
	    <td style="border: 1px solid black!important; font-weight: bold; text-align: center;"> 
        N de PEDIDO
      </td>
	    <td style="border: 1px solid black!important; font-weight: bold; text-align: center;"> 
      PLANTA
      </td>
	    <td style="border: 1px solid black!important; font-weight: bold; text-align: center;"> 
      Galones
      </td>
	    <td style="border: 1px solid black!important; font-weight: bold; text-align: center;"> 
        Monto (S/.)
      </td>
  	</tr>
      @foreach ($pedidos as $pedido)
        
        <?php $x = ''; ?>
        @foreach($pedido->pedidoProveedorGrifos as $grifo)
          <tr>
            <?php if(empty($x)){?>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}" 
                  style="border: 1px solid black!important;
                   text-align: center;vertical-align: middle;" >
              {{$pedido->vehiculo->transportista->nombre_transportista}}
            </td>
            <?php } ?>                      
            <td style="border: 1px solid black!important;
                   text-align: center;">
              {{$grifo->grifo->razon_social}}
            </td>                  
            <td style="border: 1px solid black!important;
                   text-align: center;">{{$grifo->fecha_descarga}}</td>
            <?php if(empty($x)){?>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}" 
                  style="border: 1px solid black!important;
                   text-align: center; vertical-align: middle;"> 
                {{$pedido->scop}} 
            </td>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}"
                  style="border: 1px solid black!important;
                   text-align: center; vertical-align: middle;"> 
              {{$pedido->nro_pedido}} </td>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}" 
                  style="border: 1px solid black!important;
                   text-align: center; vertical-align: middle;"> 
              {{$pedido->planta->planta}}</td>
           <?php } ?>
            <td style="border: 1px solid black!important;
                   text-align: center;">{{$grifo->asignacion}}</td> 
            <?php if(empty($x)){?>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}" 
                  style="border: 1px solid black!important;
                   text-align: center; vertical-align: middle;">
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
              <td style="border: 1px solid black!important;
                   text-align: center;">{{$cliente->pedidoCliente->cliente->razon_social}}</td>                  
              <td style="border: 1px solid black!important;
                   text-align: center;">{{$cliente->pedidoCliente->fecha_descarga}}</td>
              <td style="border: 1px solid black!important;
                   text-align: center;">{{$cliente->asignacion}}</td> 
             </tr>
           <?php $y = $pedido->id; ?>
          @endforeach
        @else
          @foreach($pedido->pedidoProveedorClientes as $cliente)
          <tr>
            <?php if(empty($y)){?>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}" 
                  style="border: 1px solid black!important;
                   text-align: center;">
              {{$pedido->vehiculo->transportista->nombre_transportista}}
            </td>
            <?php } ?>                      
            <td style="border: 1px solid black!important;
                   text-align: center;">
              {{$cliente->pedidoCliente->cliente->razon_social}}</td>                  
            <td style="border: 1px solid black!important;
                   text-align: center;">
                {{$cliente->pedidoCliente->fecha_descarga}}</td>
            <?php if(empty($y)){?>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}" 
              style="border: 1px solid black!important;
                   text-align: center;"> 
                {{$pedido->scop}}
            </td>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}"
                   style="border: 1px solid black!important;
                   text-align: center;"> 
              {{$pedido->nro_pedido}} </td>
            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}"
                   style="border: 1px solid black!important;
                   text-align: center;"> 
              {{$pedido->planta->planta}}</td>
           <?php } ?>
            <td style="border: 1px solid black!important;            
                   text-align: center;">{{$cliente->asignacion}}</td> 
            <?php if(empty($y)){?>

            <td rowspan="{{count($pedido->pedidoProveedorGrifos)+
                  count($pedido->pedidoProveedorClientes)}}" 
                  style="border: 1px solid black!important;
                   text-align: center;">
              {{$pedido->costo_flete}}
            </td> 
             <?php } ?>
          </tr>
          <?php $y = $pedido->id; ?>
          @endforeach
        @endif
      @endforeach
      
      <tr>                
        <td></td>
        <td style="border-top: 1px solid black!important;"></td>
        <td></td>
        <td></td>
        <td style="border-top: 1px solid black!important;"></td>
        <td style="border-top: 1px solid black!important; border-right: 1px solid black!important;"
        ></td>

        <td style="border: 1px solid black!important; font-weight: bold; text-align: center;">
          SUBTOTAL
        </td>
        <td style="border: 1px solid black!important; font-weight: bold; text-align: center;">S/. &nbsp; {{$subtotal}}</td>
      </tr>

      {{-- Faltantes --}}
    <tr>
      <td colspan="8"></td>
    </tr>
    <tr >
      <td colspan="8" style="font-weight: bold; text-align: center;"> Lista de Faltantes en Fletes</td>
    </tr>
	  <tr>
	    <th style="border: 1px solid black!important; font-weight: bold; text-align: center;">
        Descripcion
      </th>
	    <th style="border: 1px solid black!important; font-weight: bold; text-align: center;">
        Fecha Descarga
      </th>
      <th style="border: 1px solid black!important; font-weight: bold; text-align: center;">
       GRIFO
      </th>
	    <th style="border: 1px solid black!important; font-weight: bold; text-align: center;">
        Planta
      </th> 
	    <th style="border: 1px solid black!important; font-weight: bold; text-align: center;">
        Grifero
      </th>
	    <th style="border: 1px solid black!important; font-weight: bold; text-align: center;">
        Faltante (galones)
      </th>
	    <th style="border: 1px solid black!important; font-weight: bold; text-align: center;">
        Precio Galón (S/.)
      </th>
	    <th style="border: 1px solid black!important; font-weight: bold; text-align: center;">
      Monto Descuento (S/.)
      </th>
	  </tr>
 		@foreach ($lista_descuento as $pedido_cliente)
      <tr>
        <td style="border: 1px solid black!important;">
          {{$pedido_cliente->descripcion}}</td>
        <td style="border: 1px solid black!important;">  
          @if( $pedido_cliente->fecha_descarga )
          {{date('d/m/Y', strtotime($pedido_cliente->fecha_descarga))}}
          @else
          No acordado
          @endif
        </td>
        <td style="border: 1px solid black!important;">
          {{$pedido_cliente->razon_social}}</td>             
        <td style="border: 1px solid black!important;">
          {{$pedido_cliente->planta}}</td> 
        <td style="border: 1px solid black!important;">
          {{$pedido_cliente->grifero}}</td>
        <td style="border: 1px solid black!important;">
          {{$pedido_cliente->faltante}}</td>
        <td style="border: 1px solid black!important;">
          {{$pedido_cliente->costo_galon}}</td>
        <td style="border: 1px solid black!important;">
            {{number_format((float)
                $pedido_cliente->faltante * $pedido_cliente->costo_galon, 2, '.', '') }}              
        </td>
      </tr>
      <tr>      	         
        <td colspan="5"></td>
        <td style="border-right: 1px solid black!important;"></td>
        <td style="border: 1px solid black!important; 
          text-align: center; font-weight: bold;">TOTAL FALTANTES</td>
        <td style="border: 1px solid black!important; 
          text-align: center; font-weight: bold;">
          S/. &nbsp; {{$desc}}</td>
      </tr>
    @endforeach
  </tbody> 
</table>