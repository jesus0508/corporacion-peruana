  <div class="row">
    <div class="col-md-12">
      <h3 class="pull-left">RESUMEN DISTRIBUCIÓN PEDIDOS PROVEEDORES </h3>
      <div class="pull-right">
        <a href="{{route('pedidos.index')}}">
          <button class="btn bg-olive">
          IR PEDIDOS &nbsp; <span class="fa fa-list"></span>
          </button>
        </a>
        <a class="btn btn-primary" href="{{route('pedidos.distribuir', $pedido->id)}}">
          <i class="fa fa-th"> &nbsp; </i>Volver Distribución
        </a>

      </div>
    </div>    
  </div>