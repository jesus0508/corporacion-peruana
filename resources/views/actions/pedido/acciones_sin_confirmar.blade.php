<td> <span class="label label-danger">SIN CONFIRMAR</span> </td>
<td>

     <!-- Confirmar -->             
  <a href="{{route('pedidos.confirmarPedido',$pedido->id)}}" class="btn btn-sm btn-success"><i class="fa fa-check-square-o"> </i></a>

      <!-- Editar -->   
  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-pedido-proveedor"
    data-id="{{$pedido->id}}" data-nro_pedido="{{$pedido->nro_pedido}}" 
    data-scop="{{$pedido->scop}}" data-galones="{{$pedido->galones}}"
    data-costo_galon="{{$pedido->costo_galon}}" data-estado="{{$pedido->estado}}"
    data-planta="{{$pedido->planta->id}}"> <span class="glyphicon glyphicon-edit"></span>
  </button>
  
      <!-- Eliminar -->   

  <form style="display:inline" method="POST" action="{{ route('pedidos.destroy', $pedido->id) }}">
  @csrf
  @method('DELETE')
  <button class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>
  </form>

</td> 
