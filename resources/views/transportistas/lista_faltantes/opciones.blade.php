<div class="form-group pull-right">

  <a href="{{ route( 'flete.index' ) }}">
    <button class="btn btn-primary">
    Ver Fletes   &nbsp;&nbsp; <span class="fa fa-bus"></span>
    </button>
  </a>
  <a href="{{ route( 'flete.create' ) }}">
    <button class="btn btn-warning">
      Registrar Faltante   &nbsp;&nbsp; <span class="fa fa-minus-circle"></span>
    </button>
  </a>
  <a href="{{route('pedidos.index')}}">
    <button class="btn bg-olive">
    IR PEDIDOS &nbsp; <span class="fa fa-list"></span>
    </button>
  </a>
   <a href="#">
    <button class="btn btn-default">
    Exportar Excel&nbsp; <span class="fa fa-file-excel-o"></span>
    </button>
  </a>
</div>