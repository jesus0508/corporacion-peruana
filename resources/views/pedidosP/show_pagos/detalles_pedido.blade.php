<div class="row" >
  <div class="col-md-8">
  	<div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Datos Pedido</h3>
      </div><!-- /.box-header --> 
      <div class="box-body">
      	<div class="row">
      	  <div class="col-md-6">
  			<div class="form-group">
              <label for="scop">SCOP</label>
          	  <input type="text" class="form-control" value="{{$pedido->scop}}" readonly="">
        	</div>    			
      	  </div>
      	  <div class="col-md-6">
  			<div class="form-group">
              <label for="nro_pedido">Número de pedido</label>
         	  <input type="text" class="form-control" value="{{$pedido->nro_pedido}}" readonly="">
        	</div> 	
      	  </div>      		
      	</div>
      	<div class="row">
      	  <div class="col-md-6">
  			<div class="form-group">
              <label for="planta"> Planta</label>
          	  <input type="text" class="form-control" value="{{$pedido->planta->planta}}" readonly="">
        	</div> 	    			
      	  </div>
      	  <div class="col-md-6">
  			<div class="form-group">
          	  <label for="saldo">Saldo</label>
          	  <input type="text" class="form-control" value="{{$pedido->saldo}}" readonly="">
        	</div>
      	  </div>      		
      	</div>     	
      </div>  		
  	</div>

  </div>
  <div class="col-md-4">
  @if($pedido->factura_proveedor_id)
  	<div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Datos Factura</h3>
      </div><!-- /.box-header -->  
      <div class="box-body">
  		<div class="form-group">
          <label for="nro_factura">Número de FACTURA</label>
          <input type="text" class="form-control" value="{{$pedido->facturaProveedor->nro_factura_proveedor}}" readonly="">
        </div>
   		<div class="form-group">
          <label for="monto_factura">Monto Facturado</label>
          <input type="text" class="form-control" value="{{$pedido->facturaProveedor->monto_factura}}" readonly="">
        </div>  	
      </div> 	
  	</div>
  @endif
  </div>
</div>

 

