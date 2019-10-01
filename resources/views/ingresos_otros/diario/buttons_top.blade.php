<div class="">
	<div class="row">
		<div class="col-md-2">
		<h3>Reportes x día </h3> 			
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="">Fecha: </label>
				<input autocomplete="off" id="fecha_reporte" type="date" class="tuiker form-control" name="fecha_reporte" placeholder="Fecha reporte" required="">
			</div>						
		</div>
		<div class="col-md-4">
			<button class="btn btn-info" id="btn_filter"><span class="fa fa-search"></span>&nbsp;&nbsp;Filtrar</button>
		</div>	
		<div class="col-md-5">
			
			<a href="{{route('ingresos_otros.create')}}" class="btn btn-success pull-right"> <span class="fa fa-plus"></span>&nbsp;&nbsp; Nuevo Ingreso  </a>		
		</div>		
	</div>
</div>
<br>