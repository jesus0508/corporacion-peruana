<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label for="">SCOP </label>
	    <select id="filter-scop" class="form-control">
	     	@foreach($pedidosDistribuidos as $pedido)
	     		<option value="{{$pedido->id}}">{{$pedido->scop}}</option>
	     	@endforeach
	     </select>
    </div> 
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="">Fecha Pedido </label>
      <input autocomplete="off" id="filter-fecha" type="text" class=" form-control" placeholder="Fecha" value="" required="">
    </div> 
  </div>
  <div class="col-md-3"> 
    <button class="btn btn-info" id="button-find"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp; Buscar</button>
	 <button id="clear-fecha" class="btn btn-danger">
	  <i class="fa fa-remove "></i>
	  Limpiar
	  </button>
  </div>  
  <div class="col-md-3">
    <button class="btn btn-default" id="button-export">
      <span class="fa fa-file-excel-o"></span>
      Export Excel
    </button>
  	{{-- <a class="btn btn-default" href="{{ route('pedidos.export_view') }}"> </a> --}}
  </div>        
</div>  

