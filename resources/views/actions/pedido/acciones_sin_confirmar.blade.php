  <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa fa-wrench"></span> Acciones <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li>
        <a class="btn btn-xs bg-olive btn-block" href="{{route('pedidos.confirmarPedido',$pedido->id)}}" ><span class="glyphicon glyphicon-check"> </span> CONFIRMAR</a>
      </li>
      <li>              <!-- Editar -->   
        <btn class="btn btn-xs btn-warning btn-block" href="#modal-show-pedido_cliente" data-toggle="modal" data-target="#modal-edit-pedido-proveedor"
          data-id="{{$pedido->id}}" data-nro_pedido="{{$pedido->nro_pedido}}" 
          data-scop="{{$pedido->scop}}" data-galones="{{$pedido->galones}}"
          data-costo_galon="{{$pedido->costo_galon}}" data-estado="{{$pedido->estado}}"
          data-planta="{{$pedido->planta_id}}"> <span class="glyphicon glyphicon-edit"></span>EDITAR</btn>        
      </li>
      <li> 
       <!-- Eliminar -->  
        <form style="display:inline" method="POST" action="{{ route('pedidos.destroy', $pedido->id) }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-xs btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> ELIMINAR</button>
        </form>
      </li>

    </ul>
  </div> 
