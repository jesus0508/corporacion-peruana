
<td> <span class="label label-warning">CONFIRMADO</span> </td>
<td>
  <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="fa fa-wrench"></span> <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li>
        <a href="#modal-create-pago" data-toggle="modal" data-target="#modal-create-pago" data-id="{{$pedido_cliente->id}}"><span class="glyphicon glyphicon-check"></span>Amortizar</a>
      </li>
      <li>
        <a href="#modal-show-pedido_cliente" data-toggle="modal" data-target="#modal-show-pedido_cliente" data-id="{{$pedido_cliente->id}}"><span class="glyphicon glyphicon-eye-open"></span>Detalles Pedido</a>
      </li>
    </ul>
  </div>
</td>
