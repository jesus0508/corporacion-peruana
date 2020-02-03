<div class="row">
  <div class="col-md-2">
    <div class="input-group">
      <span class="input-group-addon">Unidad</span>
      <select class="form-control" id="filter-grifo" name="planta_id">
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
  <div class="col-md-4">
    <div class="form-group">
      <button class="btn btn-primary" id="yesterday-fecha">
      <span class="fa fa-list-alt"></span> &nbsp;{{$last_month}}
      </button>
      <input type="hidden" id="last_month_date" value="{{$last_month_date}}">
      <button class="btn btn-success" id="today-fecha">
      <span class="fa fa-list-alt"></span> &nbsp;{{$month_actual}}
      </button>
      <input type="hidden" id="month_actual_date" value="{{$month_actual_date}}">
      <button id="clear-fecha" class="btn btn-danger">
            <i class="fa fa-remove "></i>
            Limpiar
      </button>

    </div>
  </div>
  <div class="col-md-3">
    <div class="row filtrado">
      <div class="col-md-6">
        <div class="form-group">
          <label for="fecha_inicio">FECHA: </label>
          <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control"
            name="fecha_inicio" placeholder="Mes ">
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
<br>