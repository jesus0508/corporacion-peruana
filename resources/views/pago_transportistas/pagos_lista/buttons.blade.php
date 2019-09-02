<div class="content-header">
  <div class="row">
  	<div class="col-md-5">
  	  <label for="">Seleccione el Transportista que desee:</label>
      <div class="input-group">
      	<span class="input-group-addon">Proveedor</span>
      	<select class="form-control" id="filter-proveedor" name="proveedor_id">
          @foreach( $transportistas as $transportista )
            <option value="{{$transportista->id}}">{{$transportista->nombre_transportista}}</option>
          @endforeach
        </select>
	  </div>  		 
  	</div>
    <div class="col-md-6">
      <div class="row filtrado">
        <div class="col-md-5">
          <div class="form-inline">
            <label for="fecha_inicio">Desde: </label>
            <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control"
              name="fecha_inicio" placeholder="Desde">
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-inline">
            <label for="fecha_fin">Hasta: </label>
            <input autocomplete="off" id="fecha_fin" type="text" class="tuiker form-control"
              name="fecha_fin" placeholder="Final">
          </div>
        </div>
        <div class="col-md-2">
          <button id="filtrar-fecha" class="btn btn-info">
            <i class="fa fa-search"></i>
            Filtrar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>