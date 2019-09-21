<div class="row">

  <div class="col-md-5">
    <div class="form-group">
      <button class="btn btn-primary" id="yesterday-fecha">
      <span class="fa fa-table"></span>&nbsp;{{$last_month}} 
      </button>
      <button class="btn btn-success" id="today-fecha">
      <span class="fa fa-table"></span>&nbsp;{{$month_actual}}
      </button>

    </div>
  </div>

      <div class="col-md-6">
      <div class="row filtrado">
        <div class="col-md-6">
          <div class="form-inline">
            <label for="fecha_inicio">FECHA: </label>
            <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control"
              name="fecha_inicio" placeholder="Seleccione MES">
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