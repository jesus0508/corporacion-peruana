<div class="content-header">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-8">
      <div class="row filtrado">
        <div class="col-md-4">
          <div class="form-inline">
            <label for="fecha_inicio">Desde: </label>
            <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control" value="{{$today}}" 
              name="fecha_inicio" placeholder="Desde">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-inline">
            <label for="fecha_fin">Hasta: </label>
            <input autocomplete="off" id="fecha_fin" type="text" class="tuiker form-control" value="{{$today}}" 
              name="fecha_fin" placeholder="Final">
          </div>
        </div>
        <div class="col-md-4">
          <button id="filtrar-fecha" class="btn btn-info">
            <i class="fa fa-search"></i>
            Buscar
          </button>
{{--          <button id="clear-fecha" class="btn btn-danger">
            <i class="fa fa-remove "></i>
            Limpiar
          </button> --}}
        </div>
      </div>
    </div>
  </div>
</div>