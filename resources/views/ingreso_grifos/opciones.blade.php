<div class="content-header">
  <div class="row">
    <div class="col-md-4">  
    </div>
    <div class="col-md-8">
      <div class="input-group">
        <span class="input-group-addon">Grifo</span>
        <select class="form-control" id="filter-grifo">
          @foreach($grifos as $grifo)
            <option value="{{$grifo->id}}">{{$grifo->razon_social}}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <label for="">Filtro por fecha ingreso:</label>
      <div class="row filtrado">
        <div class="col-md-3">
          <div class="form-inline">
            <label for="fecha_inicio">Desde: </label>
            <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control"
              name="fecha_inicio" placeholder="Desde">
          </div>
        </div>
        <div class="col-md-3  ">
          <div class="form-inline">
            <label for="fecha_fin">Hasta: </label>
            <input autocomplete="off" id="fecha_fin" type="text" class="tuiker form-control"
              name="fecha_fin" placeholder="Final">
          </div>
        </div>
        <div class="col-md-3">
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
</div>
<br>