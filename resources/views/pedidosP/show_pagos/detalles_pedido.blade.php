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
        @if($pedido->factura_proveedor_id)
          @if(  $pedido->facturaProveedor->monto_factura - $pedido->getMonto()  < 0 
                    AND $pedido->saldo==0 )
            <div class="row">
              <div class="col-md-12">
                <div class="callout callout-info">
                  {{--   <h4>I am an info callout!</h4> --}}                  
                  <p><b>Pedido Extraordinario, se ha pagado 
                    <label for="" class="label label-default" style="font-size: 12px;" >{{round($extra,2)}}</label> extra.</b>
                    @if($existe_extraordinario)
                    Monto  amortizado 
                      @foreach($extraordinario_pagos as $pedido)
                      <a href="{{route('pago_proveedors.edit', $pedido->pedido_id)}}">aquí.
                      </a>
                      @endforeach
                    @endif
                  </p> 
                  </div>
              </div>          
            </div>
          @endif  
        @endif  	
      </div>  		
  	</div>
  </div>
  <div class="col-md-4">  
  	<div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Datos </h3>
      </div><!-- /.box-header -->  
      <div class="box-body">
        <div class="form-group">
          <label for="">Monto pedido</label>
          <input type="text" class="form-control" value="{{$pedido->getMonto()}}" readonly="">
        </div>
{{--   		<div class="form-group">
          <label for="nro_factura">Número de FACTURA</label>
          <input type="text" class="form-control" value="{{$pedido->facturaProveedor->nro_factura_proveedor}}" readonly="">
      </div> --}}
      @if($pedido->factura_proveedor_id)
     		<div class="form-group">
            <label for="monto_factura">Monto Facturado</label>
            <input type="text" class="form-control" value="{{$pedido->facturaProveedor->monto_factura}}" readonly="">
        </div>
        <div class="form-group">
          <label for="diferencia"> Diferencia
            <input type="text" class="form-control" value="{{round($pedido->facturaProveedor->monto_factura-$pedido->getMonto(),2)}}" readonly="">
          </label>          
        </div>
      @else
        <div class="form-group">
            <label for="monto_factura">Monto Facturado</label>
            <input type="text" class="form-control" value="Sin Factura" readonly="">
        </div>
      @endif 	
      </div> 	
  	</div>
  </div>
</div>

 

