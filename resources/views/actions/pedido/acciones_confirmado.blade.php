<td> 
  <span class="label label-default">CONFIRMADO</span> 
</td>
<td>

  <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa fa-wrench"></span> Acciones <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      @if( $pedido->factura_proveedor_id == null )
        <li>
          <a class="btn btn-block btn-sm bg-purple" href="{{route('pedidos.edit',$pedido->id)}}"><i class="fa fa-pencil"> &nbsp; </i>FACTURA</a>
          </li>
        @else
        <li>
          <a class="btn bg-teal btn-sm" href="{{route('pedidos.show', $pedido->id)}}">
          <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Detalles factura
          </a>
        </li>       
      @endif
      <li>
        <a class="btn btn-block btn-sm bg-orange" href="{{route('pedidos.distribuir', $pedido->id)}}">
        	<i class="fa fa-th"> &nbsp; </i>DISTRIBUIR
        </a>      	
      </li>
    </ul>
  </div>
 <!-- <a class="btn btn-info" href="{{route('pedidos.show', $pedido->id)}}">
  <span class="glyphicon glyphicon-eye-open"></span>&nbsp;DETALLES
  </a> -->
           
</td> 
