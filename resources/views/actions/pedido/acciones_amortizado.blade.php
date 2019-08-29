<td> <span class="bg-green label">AMORTIZADO</span>
</td>
<td>  
  <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="fa fa-wrench"></span> Acciones <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
    	<li>
    	  <a class="btn bg-navy btn-sm" href="{{route('pedidos.show', $pedido->id)}}">
            <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Detalles pedido
          </a>
    	</li>
    	<li>
    	  <a class="btn bg-maroon btn-sm" href="{{route('pago_proveedors.edit', $pedido->id)}}">
            <span class="fa fa-money"></span>&nbsp;Detalles PAGO
          </a>
    	</li>
    	<li> 
       	  <a href="{{route('pedidos.ver_distribucion', $pedido->id)}}" class="btn btn-sm bg-aqua"><i class="fa fa-th"> &nbsp; </i>Ver Distribución</a> 
    	</li>
    </ul>
  </div>                
</td> 