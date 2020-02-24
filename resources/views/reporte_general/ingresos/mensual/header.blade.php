<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-4">
    <div class="form-group">
      <button class="btn btn-primary" id="yesterday-fecha">
      <span class="fa fa-list-alt"></span> &nbsp;{{$last_month}}
      </button>
      <input type="hidden" id="last_month_date_my" value="{{$last_month_date_my}}">
      <input type="hidden" id="last_month_date" value="{{$last_month_date}}">      
      <button class="btn btn-success" id="today-fecha">
      <span class="fa fa-list-alt"></span> &nbsp;{{$month_actual}}
      </button>
      <input type="hidden" id="month_actual_date_my" value="{{$month_actual_date_my}}">
      <input type="hidden" id="month_actual_date" value="{{$month_actual_date}}">
    </div>
  </div>

  <div class="col-md-5">
      <div class="row filtrado">
        <div class="col-md-6">
          <div class="form-inline">
            <label for="fecha_inicio">FECHA: </label>
            <input autocomplete="off" id="fecha_reporte2" type="text" class="form-control"
               placeholder="Seleccione MES" value="{{$month_actual_date}}">
          </div>
        </div>
        <div class="col-md-6 pull-right" >
          <button id="btn_filter2" class="btn btn-info">
            <i class="fa fa-search"></i>
            Filtrar
          </button>
        </div>
      </div>
  </div>
</div>
<br>