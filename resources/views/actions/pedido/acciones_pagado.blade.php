                  <td> <span class="label label-success">PAGADO</span> </td>
                  <td>                  
 

                 <a class="btn btn-info" href="{{route('pedidos.show', $pedido->id)}}">

                   <span class="glyphicon glyphicon-eye-open"></span>&nbsp;DETALLES
                    </a>

 			@if( $pedido->getGalonesStock() <= 0 )

     			 <a href="{{route('pedidos.ver_distribucion', $pedido->id)}}" class="btn btn-primary"><i class="fa fa-th"> &nbsp; </i>Ver Distribución</a>

   			 @else
     			<a href="{{route('pedidos.distribuir', $pedido->id)}}" class="btn btn-primary"><i class="fa fa-th"> &nbsp; </i>DISTRIBUIR</a>
  			@endif                 
             

                  </td> 

