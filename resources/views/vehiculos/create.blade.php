  <form action="{{route('vehiculo.store')}}" method="post">
    	 @csrf
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">VEHÍCULO - CISTERNA </h3>
          <button type="submit" class="btn  btn-success pull-right">
    		    <i class="fa fa-plus-square-o"> </i>
    		   Asignar Vehículo a Transportista
    	 </button>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <label for="nombre_transportista">Nombre de transportista</label>
            <select class="form-control" id="transportista" name="transportista_id">
              @isset($transportistas)
                    @foreach ( $transportistas as $transportista)

                      <option selected="true" value="{{$transportista->id}}">{{$transportista->nombre_transportista}}</option>
                    @endforeach
              @endisset

            </select>
            
          </div>
          <div class="form-group">
            <label for="placa">Placa*</label>
            <input id="placa" type="text" class="form-control" 
                    name="placa" placeholder="Ingrese la PLACA">
            
          </div>
          <div class="form-group">
            <label for="marca">Marca</label>
            <input id="marca" type="text" class="form-control" 
                    name="marca" placeholder="Ingrese la Marca">
            </div>
          <div class="form-group">
            <label for="modelo">Modelo</label>
            <input id="modelo" type="tel" class="form-control"
                    name="modelo" placeholder="Ingrese el modelo">
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
      	
    </div> <!-- /.col-md-6 -->
	</form>
  