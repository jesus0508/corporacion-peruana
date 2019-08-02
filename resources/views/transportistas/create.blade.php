
 
  <div class="row">
    <!-- left column -->
    <form action="{{route('transportista.store')}}" method="post">
    	 @csrf
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">DATOS TRANSPORTISTA</h3>
          <button type="submit" class="btn  btn-success pull-right">
    		    <i class="fa fa-plus-square-o"> </i>
    		    Registrar nuevo transportista
    		  </button>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <label for="nombre_transportista">Nombre*</label>
            <input id="nombre_transportista" type="text" class="form-control" 
                    name="nombre_transportista" placeholder="Ingrese su Nombre">
            
          </div>
          <div class="form-group">
            <label for="brevete">Brevete*</label>
            <input id="brevete" type="text" class="form-control" 
                    name="brevete" placeholder="Ingrese el Brevete">
            </div>
          <div class="form-group">
            <label for="celular_transportista">Celular</label>
            <input id="celular_transportista" type="tel" class="form-control"
                    name="celular_transportista" placeholder="Ingrese el numero de celular del transportista">
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
      	<div class="row">
    		<div class="col-md-6">
    		  
    		</div>
  		</div> <!-- /.row-bottom -->
    </div> <!-- /.col-md-6 -->
	</form>
    <!--/.col (left) -->
  	@include('vehiculos.create')
  
    <!--/.col (left) -->
  </div> <!-- /.row-top -->


