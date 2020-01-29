<div class="row">
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Grifo</span>
      <select class="form-control" id="filter-grifo">
        @foreach( $grifos as $grifo )
          <option value="{{$grifo->id}}">{{$grifo->razon_social}}</option>
        @endforeach
      </select>
    </div><!-- /input-group -->
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <button class="btn btn-sm btn-primary" id="yesterday-fecha">
      <span class="fa fa-list-alt"></span> &nbsp;{{$last_month}}
      </button>
      <input type="hidden" id="last_month_date_my" value="{{$last_month_date_my}}">
      <input type="hidden" id="last_month_date" value="{{$last_month_date}}">      
      <button class="btn btn-sm btn-success" id="today-fecha">
      <span class="fa fa-list-alt"></span> &nbsp;{{$month_actual}}
      </button>
      <input type="hidden" id="month_actual_date_my" value="{{$month_actual_date_my}}">
      <input type="hidden" id="month_actual_date" value="{{$month_actual_date}}">
      <button id="clear-fecha" class="btn btn-sm btn-danger">
            <i class="fa fa-remove "></i>
            Limpiar
      </button>
    </div>

  </div>

  <div class="col-md-3">
      <div class="row filtrado">
        <div class="col-md-8">
          <div class="form-group">
            <label for="fecha_inicio">Fecha mes egreso: </label>
            <input autocomplete="off" id="fecha_reporte2" type="text" class="form-control"
               placeholder="Seleccione MES" value="{{$month_actual_date}}">
          </div>
        </div>
        <div class="col-md-4 pull-right" >
          <button id="btn_filter2" class="btn btn-sm btn-info">
            <i class="fa fa-search"></i>
            Filtrar
          </button>
        </div>
      </div>
  </div>
</div>