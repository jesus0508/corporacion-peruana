  <div class="row">
    <div class="col-md-12">
      <h3 class="pull-left">RESUMEN DISTRIBUCIÓN PEDIDOS PROVEEDORES </h3>
      <div class="pull-right">
        @if( isset($pedidos_cl) )
          <button class="btn btn-default" id="export_distribucion_table">  <span class="fa  fa-file-excel-o"></span>
            Exportar Excel            
          </button>
        @endif
        <a href="{{route('pedidos.index')}}">
          <button class="btn bg-olive">
          IR PEDIDOS &nbsp; <span class="fa fa-list"></span>
          </button>
        </a>
        @if( $pedido->getGalonesStock() > 0 )
        <a class="btn btn-primary" href="{{route('pedidos.distribuir', $pedido->id)}}">
          <i class="fa fa-th"> &nbsp; </i>Volver Distribución
        </a>
        @endif
      </div>
    </div>    
  </div>