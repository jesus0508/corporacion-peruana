<td> <span class="label label-warning">CONFIRMADO</span> 
	@if( $pedido->getGalonesStock() <= 0 )
      </br>
      <span class="label label-success">DISTRIBUIDO</span> 
    @elseif( $pedido->getGalonesStock() <  $pedido->galones)
                  			</br><span class="label label-warning">DISTRIBUIDO parcial</span> 

      @else
                  			</br><span class="label label-danger">SIN DISTRIBUIR</span>
                  		
  @endif

</td>
<td>

  @if( $pedido->getGalonesStock() <= 0 )

      <a href="{{route('pedidos.ver_distribucion', $pedido->id)}}" class="btn btn-primary"><i class="fa fa-th"> &nbsp; </i>Ver Distribución</a>

    @else
      <a href="{{route('pedidos.distribuir', $pedido->id)}}" class="btn btn-primary"><i class="fa fa-th"> &nbsp; </i>DISTRIBUIR</a>
  @endif

  <a class="btn btn-info" href="{{route('pedidos.show', $pedido->id)}}">
  <span class="glyphicon glyphicon-eye-open"></span>&nbsp;DETALLES
  </a>
           
</td> 
