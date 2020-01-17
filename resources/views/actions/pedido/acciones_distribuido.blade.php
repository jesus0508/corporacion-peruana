  <div class="btn-group">
  	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa fa-wrench"></span> Acciones <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">

  		@if( $pedido->factura_proveedor_id == null )
  		  <li>
      		<a class="btn btn-block btn-sm bg-purple" href="{{route('pedidos.edit',$pedido->id)}}"><i class="fa fa-pencil"> &nbsp; </i>FACTURA</a>
      	</li>
        <li>
          <a class="btn bg-navy btn-sm" href="{{route('pedidos.show', $pedido->id)}}">
            <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Detalles pedido
          </a>
        </li>      
      	@else
 	  	  <li>
	  	    <a class="btn bg-teal btn-sm" href="{{route('pedidos.show', $pedido->id)}}">
  			  <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Detalles factura
  		    </a>
	  	  </li>   		
  		@endif
      <li>
      	<a href="{{route('pedidos.ver_distribucion', $pedido->id)}}" class="btn btn-sm bg-aqua"><i class="fa fa-th"> &nbsp; </i>Ver Distribución</a>      	
      </li>
      <li> {{-- onsubmit="return confirmar()" --}}
        <form style="display:inline" method="POST" action="{{route('pedidos.reverse', $pedido->id)}}">
          @csrf
          @method('DELETE')
          <button class="btn btn-sm btn-danger btn-block"><span class="fa fa-undo"></span>&nbsp;Deshacer Distribución</button>
        </form>        
      </li>
	  </ul> 
  </div>         
