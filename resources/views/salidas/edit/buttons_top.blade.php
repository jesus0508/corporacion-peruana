<div class="">
	<div class="row">
		<div class="col-md-2">
		<h3>Egresos </h3> 			
		</div>
		<div class="col-md-3">
      <div class="form-group">
            <label for="">Fecha: </label>
            <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control" name="fecha_inicio" placeholder="Fecha reporte" value="{{$today}}" required="">
      </div>				
		</div>
    <div class="col-md-5">
      <div class="row filtrado">
        <div class="col-md-6" >
          <button id="filtrar-fecha" class="btn btn-info">
            <i class="fa fa-search"></i>
            Filtrar
          </button>
          <button id="clear-fecha" class="btn btn-danger">
            <i class="fa fa-remove "></i>
            Limpiar
      		</button>
        </div>
    	</div>
    </div>
    <div class="col-md-2">
    	<!-- <input type="text" id="pruebita" value="0"> -->
    </div>	
		<div class="col-md-2">			
			<a href="{{route('salidas.create')}}" class="btn btn-success pull-right"> <span class="fa fa-plus"></span>&nbsp;&nbsp; Nuevo Egreso  </a>	
		</div>		
	</div>
</div>
<br>