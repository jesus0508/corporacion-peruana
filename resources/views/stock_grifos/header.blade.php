<div class="row">
	<div class="col-md-7">
		<div class="alert alert-info alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Para habilitar el registro:</h4>
      <p> 
      	<label for="" class="label label-default">1. Escoja la fecha de stock</label>
      	<label for="" class="label label-default">2. Escoja el grifo que desea</label>
      	<!-- <label for="" class="label label-default">Asegurese que el grifo tenga una serie asociada</label> -->
      </p>
    </div>		
	</div>
	<div class="col-md-5">
<!-- 		<div class="row">
			<br>
			<br>
		</div> -->
		<div class="row">
			<div class="col-md-12">
				<div class="pull-right">
					<a class="btn btn-primary" href="{{route('grifos.index')}}">
						<i class="fa fa-building-o"></i> &nbsp;Gestion
					</a>
					<a class="btn btn-success" href="{{route('cancelacion.create')}}">
						<i class="fa fa-plus"></i>&nbsp;Registrar Cancelación
          </a>
          <a class="btn btn-info" href="{{route('cancelacion.index')}}">
						<i class="fa fa-list"></i>&nbsp;Cancelaciones 
          </a>		
				</div>						
			</div>	
		</div>
	</div>
</div>
<div class="row">
	<p></p>	
</div>