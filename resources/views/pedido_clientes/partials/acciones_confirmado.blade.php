
<td> <span class="label label-success">CONFIRMADO</span> </td>
<td>
  <button class="btn btn-info" data-toggle="modal" data-target="#modal-show-pedido_cliente"
    data-id="{{$pedido_cliente->id}}" data-nro_pedido="{{$pedido_cliente->nro_pedido}}" data-fecha_pedido="{{date('d/m/Y', strtotime($pedido_cliente->created_at))}}"
    data-fecha_descarga="{{date('d/m/Y', strtotime($pedido_cliente->fecha_descarga))}}" data-grifo="{{$pedido_cliente->grifo}}" data-galones="{{$pedido_cliente->galones}}"
    data-precio_galon="{{$pedido_cliente->precio_galon}}" data-horario_descarga="{{$pedido_cliente->horario_descarga}}"
    data-precio_total="{{$pedido_cliente->getPrecioTotal()}}" data-observacion="{{$pedido_cliente->observacion}}">
    <span class="glyphicon glyphicon-eye-open"></span>
  </button>
  <a href="#" class="btn btn-success">Pagos</a>
</td>
