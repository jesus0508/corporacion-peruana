  <div class="row">
    <div class="col-md-12">
      <h3 class="pull-left">DISTRIBUCIÓN de PEDIDO</h3>
      <div class="pull-right">
        <a href="{{route('pedidos.index')}}">
          <button class="btn bg-olive">
          IR PEDIDOS &nbsp; <span class="fa fa-list"></span>
          </button>
        </a>&nbsp;
        @if( $pedido->vehiculo_id == null )
         <a href="#collapseCisterna" class="btn btn-primary" data-toggle="collapse" aria-expanded="false" aria-controls="collapseCisterna">
          <span class="fa fa-plus"> </span>&nbsp;
          Agregar Transportista
        </a>
        @else 
         <a href="#collapseCisternaShow" class="btn btn-primary" data-toggle="collapse" aria-expanded="false" aria-controls="collapseCisternaShow">
          <span class="fa fa-eye"> </span>&nbsp;
          Ver Transportista
        </a>
        @endif
        &nbsp;
        @if( $pedido->getGalonesStock() > 0)
        <a class="btn bg-orange" href="{{route('pedidos.distribuir_grifo', $pedido->id)}}">
          <i class="fa fa-th"> &nbsp; </i>DISTRIBUIR EN GRIFO(S)
        </a> 
        @endif 
      </div>
    </div>    
  </div>