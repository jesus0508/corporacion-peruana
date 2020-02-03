<div class="row">
  <div class="col-md-2">
    <div class="input-group">
      <span class="input-group-addon">Placa</span>
      <select class="form-control" id="filter-grifo">
        @foreach( $transportes as $transporte )
          <option value="{{$transporte->id}}">{{$transporte->placa}}</option>
        @endforeach
      </select>
    </div><!-- /input-group -->
  </div>
  <div class="col-md-3">
    <div class="input-group">
      <span class="input-group-addon">Tipo</span>
      <select class="form-control" id="filter-tipo">
        <option value="1">Autos</option>
        <option value="2">Buses</option>
        <option value="3">Cisternas</option>
        <option value="4">Administrativo</option>
      </select>
    </div><!-- /input-group -->
  </div>
  <div class="col-md-7">
    <div class="row filtrado">
      <div class="col-md-3">
        <div class="form-group">
            <label for="fecha_inicio">Fecha: </label>
            <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control"
              name="fecha_inicio" placeholder="Fecha reporte ">
        </div>      
      </div>
      <div class="col-md-2">
        <button id="filtrar-fecha" class="btn btn-sm btn-info">
          <i class="fa fa-search"></i>
          Filtrar
        </button>  
      </div>
      <div class="col-md-3" >
        <div class="form-group">
            <label for="fecha_inicio">Mes: </label>
            <input autocomplete="off" id="fecha_inicio2" type="text" class="tuiker form-control"
              placeholder="Escoga el mes">
        </div> 
      </div> 
      <div class="col-md-4">
        <div class="">
            <button id="filtrar-fecha-mes" class="btn btn-sm btn-info">
            <i class="fa fa-search"></i>
            Filtrar x mes
          </button>      
          <button id="clear-fecha" class="btn btn-sm btn-danger">
            <i class="fa fa-remove "></i>
            Limpiar
          </button>
        </div>
        
      </div>
    </div>
  </div>
</div>