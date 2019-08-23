<div class="content-header">
  <div class="row">
    {{-- <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">Grifo</span>
        <select class="form-control" id="filter-grifo" name="grifo_id">

        </select>
      </div><!-- /input-group -->
    </div> --}}
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