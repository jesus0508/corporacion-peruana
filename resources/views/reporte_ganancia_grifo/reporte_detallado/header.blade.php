<div class="row">
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Grifo</span>
      <select class="form-control" id="filter-grifo" name="planta_id">
        @foreach( $grifos as $grifo )
          <option value="{{$grifo->id}}">{{$grifo->razon_social}}</option>
        @endforeach
      </select>
    </div><!-- /input-group -->
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <button class="btn btn-sm btn-primary" id="yesterday-fecha">
      <span class="fa fa-list-alt"></span> &nbsp;{{$yesterday}}
      <input type="hidden" id="yesterday_date" value="{{$yesterday_date}}">
      </button>
      <button class="btn btn-sm btn-success" id="today-fecha">
      <span class="fa fa-list-alt"></span> &nbsp;{{$today}}
      <input type="hidden" id="today_date" value="{{$today_date}}">
      </button>
      <button id="clear-fecha" class="btn btn-sm btn-danger">
            <i class="fa fa-remove "></i>
            Limpiar
      </button>
    </div>
  </div>

  <div class="col-md-3">
      <div class="row filtrado">
        <div class="col-md-6">
          <div class="">
            <label for="fecha_inicio">Fecha Ingreso: </label>
            <input autocomplete="off" id="fecha_inicio" type="text" class="form-control"
              name="fecha_inicio" placeholder="Fecha ingreso">
          </div>
        </div>
        <div class="col-md-6 pull-right" >
          <button id="filtrar-fecha" class="btn btn-sm btn-info">
            <i class="fa fa-search"></i>
            Filtrar
          </button>


        </div>
      </div>
  </div>
</div>