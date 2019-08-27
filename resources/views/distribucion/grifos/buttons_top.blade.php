  <div class="row">
    <div class="col-md-12">
      <h3 class="pull-left">DISTRIBUCIÓN de PEDIDO a GRIFOS</h3>
      <div class="pull-right">
        <a href="{{route('pedidos.index')}}">
          <button class="btn bg-olive">
          IR PEDIDOS &nbsp; <span class="fa fa-list"></span>
          </button>
        </a>&nbsp;

        @if( $pedido->getGalonesStock() > 0)
        <a class="btn bg-orange" href="{{route('pedidos.distribuir', $pedido->id)}}">
          <i class="fa fa-th"> &nbsp; </i>DISTRIBUIR EN PEDIDOS de CLIENTES
        </a> 
        @endif 
      </div>
    </div>    
  </div>