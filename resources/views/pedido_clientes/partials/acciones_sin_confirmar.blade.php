<td> <span class="label label-danger">SIN CONFIRMAR</span> </td>
<td>
  <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa fa-wrench"></span> <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li>
        <a href="#modal-confirmar_pedido" data-toggle="modal" data-target="#modal-confirmar_pedido"  data-id="{{$pedido_cliente->id}}">
          <span class="glyphicon glyphicon-check"></span>
          Confirmar
        </a>
      </li>
      <li>
        <a href="#modal-show-pedido_cliente" data-toggle="modal" data-target="#modal-show-pedido_cliente"  data-id="{{$pedido_cliente->id}}">
          <span class="glyphicon glyphicon-eye-open"></span>
          Detalles Pedido
        </a>
      </li>
      <li>
        <a href="#modal-edit-pedido_cliente" data-toggle="modal" data-target="#modal-edit-pedido_cliente"  data-id="{{$pedido_cliente->id}}">
          <span class="glyphicon glyphicon-edit"></span>
          Editar
        </a>
      </li>
      <li>
        <a class="btn-eliminar" href="" data-id="{{$pedido_cliente->id}}"><span class="glyphicon glyphicon-trash"></span>Eliminar</a>
      </li>
    </ul>
  </div>
</td>
