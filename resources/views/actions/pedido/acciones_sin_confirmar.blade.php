<td> <span class="label label-danger">SIN CONFIRMAR</span> </td>
<td>

                  
  <a href="{{route('pedidos.edit',$pedido->id)}}" class="btn btn-success"><i class="fa fa-check-square-o"> &nbsp; </i>CONFIRMAR</a>


 
  <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-pedido-proveedor"
    data-id="{{$pedido->id}}" data-nro_pedido="{{$pedido->nro_pedido}}" 
    data-scop="{{$pedido->scop}}" data-galones="{{$pedido->galones}}"
    data-costo_galon="{{$pedido->costo_galon}}" data-estado="{{$pedido->estado}}"
    data-planta="{{$pedido->planta->id}}"> <span class="glyphicon glyphicon-edit"></span>
  </button>
  


  <form style="display:inline" method="POST" action="{{ route('pedidos.destroy', $pedido->id) }}">
  @csrf
  @method('DELETE')
  <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
  </form>

</td> 
