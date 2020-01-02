<div class="row">
  <div class="col-md-3">
    <div class="input-group">
      <span class="input-group-addon">Placa</span>
      <select class="form-control" id="filter-grifo">
        @foreach( $transportes as $transporte )
          <option value="{{$transporte->id}}">{{$transporte->placa}}</option>
        @endforeach
      </select>
    </div><!-- /input-group -->
  </div>
  <div class="col-md-1"></div>
  <div class="col-md-5">
    <div class="row filtrado">
      <div class="col-md-6">
        <div class="form-inline">
            <label for="fecha_inicio">FECHA: </label>
            <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control"
              name="fecha_inicio" placeholder="Fecha reporte ">
          </div>
      </div>
      <div class="col-md-6 pull-right" >
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
</div>