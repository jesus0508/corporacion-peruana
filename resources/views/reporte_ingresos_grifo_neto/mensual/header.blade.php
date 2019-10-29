<div class="row">
  <div class="col-md-3">
    <div class="input-group">
      <span class="input-group-addon">Grifo</span>
      <select class="form-control" id="filter-grifo" name="planta_id">
        @foreach( $grifos as $grifo )
          <option value="{{$grifo->id}}">{{$grifo->razon_social}}</option>
        @endforeach
      </select>
    </div><!-- /input-group -->
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <button class="btn btn-primary" id="yesterday-fecha">
      <span class="fa fa-list-alt"></span> &nbsp;{{$last_month}}
      </button>
      <button class="btn btn-success" id="today-fecha">
      <span class="fa fa-list-alt"></span> &nbsp;{{$month_actual}}
      </button>
      <button id="clear-fecha" class="btn btn-danger">
            <i class="fa fa-remove "></i>
            Limpiar
      </button>

    </div>
  </div>

      <div class="col-md-5">
      <div class="row filtrado">
        <div class="col-md-6">
          <div class="form-inline">
            <label for="fecha_inicio">FECHA: </label>
            <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control"
              name="fecha_inicio" placeholder="Ingrese día">
          </div>
        </div>
        <div class="col-md-6 pull-right" >
          <button id="filtrar-fecha" class="btn btn-info">
            <i class="fa fa-search"></i>
            Filtrar
          </button>


        </div>
      </div>
    </div>
</div>