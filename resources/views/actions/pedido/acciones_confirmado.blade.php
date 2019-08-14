<td> 
  <span class="label label-default">CONFIRMADO</span> 
</td>
<td>

      <a href="{{route('pedidos.edit',$pedido->id)}}" class="btn btn-primary"><i class="fa fa-pencil"> &nbsp; </i>FACTURA</a>
      <a href="{{route('pedidos.distribuir', $pedido->id)}}" class="btn btn-primary"><i class="fa fa-th"> &nbsp; </i>DISTRIBUIR</a>

 <!-- <a class="btn btn-info" href="{{route('pedidos.show', $pedido->id)}}">
  <span class="glyphicon glyphicon-eye-open"></span>&nbsp;DETALLES
  </a> -->
           
</td> 
