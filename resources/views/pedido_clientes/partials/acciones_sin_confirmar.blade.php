<td> <span class="label label-danger">SIN CONFIRMAR</span> </td>
<td>
  <a href="{{route('pedidos.index')}}" class="btn btn-success">CONFIRMAR</a>
  <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-pedido_cliente"
    data-id="{{$pedido_cliente->id}}" data-nro_pedido="{{$pedido_cliente->nro_pedido}}" data-fecha_pedido="{{date('d/m/Y', strtotime($pedido_cliente->created_at))}}" 
    data-scop="{{$pedido_cliente->scop}}" data-grifo="{{$pedido_cliente->grifo}}" data-planta="{{$pedido_cliente->planta}}"
    data-galones="{{$pedido_cliente->galones}}" data-precio_galon="{{$pedido_cliente->precio_galon}}" data-horario_descarga="{{$pedido_cliente->horario_descarga}}"
    data-precio_total="{{$pedido_cliente->getPrecioTotal()}}" data-observacion="{{$pedido_cliente->observacion}}">
  <span class="glyphicon glyphicon-edit"></span>
  </button>
  <form style="display:inline" method="POST" action="{{ route('pedido_clientes.destroy', $pedido_cliente->id) }}">
  @csrf
  @method('DELETE')
  <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
  </form>
</td>
