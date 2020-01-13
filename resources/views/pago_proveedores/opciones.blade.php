<div class="box-header">
  <div class="row">
    <div class="col-md-12">  

        <h3 class="box-title">PEDIDOS CONFIRMADOS SIN PAGAR O PAGO PARCIAL &nbsp; &nbsp; &nbsp;
        </h3>  
{{--         <h4 class="box-title">El pago se realizará en este orden:</h4>    --}}
        <div class="pull-right">
          <a href="{{route('pedidos.index')}}">
            <button class="btn bg-olive">
              <span class="fa fa-list"></span>  &nbsp;  IR PEDIDOS 
            </button>
          </a>
          <a href="{{route('factura_proveedor.create')}}">
            <button class="btn bg-purple">
              <i class="fa fa-share-square-o"></i>  &nbsp;  Registrar Factura 
            </button>
          </a>
          <a href="{{route('pago_proveedors.index')}}">
            <button class="btn bg-maroon">
              <i class="fa fa-money"></i>  &nbsp; Pagos  
            </button>
          </a> 
      </div>
    </div>              
  </div>           
</div>