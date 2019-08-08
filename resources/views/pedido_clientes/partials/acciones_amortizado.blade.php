<td> <span class="label label-info">AMORTIZADO</span> </td>
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
        <a href="{{route('pedido_clientes.detalles',$pedido_cliente->id)}}"><span class="glyphicon glyphicon-eye-open"></span>Detalles Pedido</a>
      </li>
      <li>
        <a href="{{route('pago_clientes.index')}}"><span class="glyphicon glyphicon-eye-open"></span>Detalles Pagos</a>
      </li>
    </ul>
  </div>
</td>