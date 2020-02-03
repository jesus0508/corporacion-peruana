<div class="row">
  <div class="col-md-3">
    <div class="input-group">
      <span class="input-group-addon">Transporte</span>
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
  <div class="col-md-3">
    <div class="form-group">
      <button class="btn btn-primary" id="yesterday-fecha1" value="{{date('Y')-2}}">
      <span class="fa fa-calendar"></span>&nbsp;&nbsp;{{date('Y')-2}}
      </button>
      <button class="btn btn-primary" id="yesterday-fecha" value="{{date('Y')-1}}">
      <span class="fa fa-calendar"></span>&nbsp;&nbsp;{{date('Y')-1}}
      </button>
      <button class="btn btn-success" id="today-fecha" value="{{date('Y')}}">
      <span class="fa fa-calendar"></span>&nbsp;&nbsp;{{date('Y')}}
      </button>
    </div>
  </div>
      <div class="col-md-2">
      <div class="row filtrado">
        <div class="form-group">
          <label for="">Ingrese el año:</label>
         <input type="text" id="datepicker" value="{{date('Y')}}" autocomplete="off" class="form-control" />
        </div>
      </div>
    </div>
</div>