<td> <span class="label label-success">PAGADO</span> </td>
<td>
  <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="fa fa-wrench"></span> <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      @if(!$pedido_cliente->facturaCliente)
      <li>
        <a href="#modal-agregar_factura" data-toggle="modal" data-target="#modal-agregar_factura"  data-id="{{$pedido_cliente->id}}">
          <span class="glyphicon glyphicon-check"></span>
          Agregar Facturas
        </a>
      </li>
      @endif
      <li>
        <a href="{{route('pedido_clientes.detalles',$pedido_cliente->id)}}"><span class="glyphicon glyphicon-eye-open"></span>Detalles Pedido</a>
      </li>
      {{-- <li>
        <a href="{{route('pedido_clientes.pagos',$pedido_cliente->id)}}"><span class="glyphicon glyphicon-eye-open"></span>Detalles Pagos</a>
      </li> --}}
    </ul>
  </div>
</td>