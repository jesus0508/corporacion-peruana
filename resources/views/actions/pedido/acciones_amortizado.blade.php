  <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="fa fa-wrench"></span> Acciones <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      @if( $pedido->factura_proveedor_id == null )
        <li>
          <a class="btn btn-block btn-sm bg-purple" href="{{route('pedidos.edit',$pedido->id)}}"><i class="fa fa-pencil"> &nbsp; </i>FACTURA</a>
        </li>              
      @endif
    	<li>        
    	  <a class="btn bg-navy btn-sm" href="{{route('pedidos.show', $pedido->id)}}">
            <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Detalles pedido
          </a>
    	</li>
    	<li>
    	  <a class="btn bg-maroon btn-sm" href="{{route('pago_proveedors.edit', $pedido->id)}}">
            <span class="fa fa-money"></span>&nbsp;Detalles PAGO
        </a>
    	</li>
    	@if($pedido->galones_distribuidos==0)
        <li>
          <a class="btn btn-block btn-sm bg-orange" href="{{ route('pedidos.distribuir', $pedido->id) }}">
            <i class="fa fa-th"> &nbsp; </i>DISTRIBUIR
          </a>        
        </li>
      @else
        <li> 
          <a href="{{route('pedidos.ver_distribucion', $pedido->id)}}" class="btn btn-sm bg-aqua"><i class="fa fa-th"> &nbsp; </i>Ver Distribución</a> 
        </li>
      @endif
    </ul>
  </div>               
