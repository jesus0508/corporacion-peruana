<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa fa-wrench"></span> Acciones <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    @if( $pedido->factura_proveedor_id == null )
      <li>
        <a class="btn btn-block btn-sm bg-purple" href="{{ route('pedidos.edit',$pedido->id) }}"><i class="fa fa-pencil"> &nbsp; </i>FACTURA</a>
      </li>
      <li>              <!-- Editar -->   
        <btn class="btn btn-xs btn-warning btn-block" href="#modal-show-pedido_cliente" data-toggle="modal" data-target="#modal-edit-pedido-proveedor"
          data-id="{{$pedido->id}}" data-nro_pedido="{{$pedido->nro_pedido}}" 
          data-scop="{{$pedido->scop}}" data-galones="{{$pedido->galones}}"
          data-costo_galon="{{$pedido->costo_galon}}" data-estado="{{$pedido->estado}}"
          data-planta="{{$pedido->planta_id}}"> <span class="glyphicon glyphicon-edit"></span>
        EDITAR</btn>        
      </li>
      <li> 
       <!-- Eliminar -->  
        <form style="display:inline" method="POST" action="{{ route('pedidos.destroy', $pedido->id) }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-xs btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> ELIMINAR</button>
        </form>
      </li>
    @else
      <li>
        <a class="btn bg-teal btn-sm" href="{{ route('pedidos.show', $pedido->id) }}">
          <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Detalles factura
        </a>
      </li>       
    @endif
      <li>
        <a class="btn btn-block btn-sm bg-orange" href="{{ route('pedidos.distribuir', $pedido->id) }}">
        	<i class="fa fa-th"> &nbsp; </i>DISTRIBUIR
        </a>      	
      </li>
  </ul>
</div>

            
