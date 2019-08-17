
<td> 
  <span class="label bg-orange">DISTRIBUIDO</span> 
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
      	<a href="{{route('pedidos.ver_distribucion', $pedido->id)}}" class="btn btn-sm bg-aqua"><i class="fa fa-th"> &nbsp; </i>Ver Distribución</a>      	
      </li>



	</ul> 
  </div>         
</td> 