  <div class="row">
    <div class="col-md-12">
      <h3 class="pull-left">FACTURA de PEDIDO a PROVEEDOR</h3>
      <div class="pull-right">
        @if( isset($pedido) )
          @if( $pedido->estado >= 4 )
            <a class="btn bg-maroon btn-sm" href="{{route('pago_proveedors.edit', $pedido->id)}}">
              Detalles PAGO &nbsp;<span class="fa fa-money"></span>
            </a>
          @endif
        @endif
        <a href="{{route('pedidos.index')}}">
          <button class="btn bg-olive">
          IR PEDIDOS &nbsp; <span class="fa fa-list"></span>
          </button>
        </a>
        <a href="{{route('factura_proveedor.create')}}">
          <button class="btn bg-purple">
        Registrar otra Factura &nbsp;   <i class="fa fa-share-square-o"></i>
          </button>
        </a>
      </div>
    </div>    
  </div>