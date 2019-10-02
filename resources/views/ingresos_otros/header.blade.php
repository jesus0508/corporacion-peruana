<div class="container">
	<div class="row">
		<div class="col-md-3">
			<h3>Registrar Nuevo Ingreso</h3>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label for="">Fecha* </label>
				<input autocomplete="off" id="fecha_reporte" type="date" class="tuiker form-control" name="fecha_reporte" placeholder="Fecha reporte" required="">
			</div>						
		</div>
		<div class="col-md-1">
			<button class="btn btn-info" id="btn_filter">Filtrar</button>
		</div>	
		<div class="col-md-5">
			<a href="{{route('categoria_ingresos.index')}}" class="btn btn-success "> <span class="fa fa-list"></span>&nbsp;&nbsp;Lista  Ingreso Categorías</a>
			<button class="btn btn-primary"  data-toggle="modal" data-target="#modal-add-categoria" ><span class="fa fa-plus"></span> 
			&nbsp;Nueva Categoría Ingreso</button>			
		</div>		
	</div>
</div>
<br>