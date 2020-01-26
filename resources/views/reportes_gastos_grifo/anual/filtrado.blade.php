<div class="row">

  <div class="col-md-5">
    <div class="form-group">
      <button class="btn btn-primary" id="yesterday-fecha">
      <span class="fa fa-calendar"></span>&nbsp;&nbsp;{{$last_year}}
      </button>
      <button class="btn btn-success" id="today-fecha">
      <span class="fa fa-calendar"></span>&nbsp;&nbsp;{{$year}}
      </button>
      <button class="btn btn-primary" id="today-fecha1">
      <span class="fa fa-calendar"></span>&nbsp;&nbsp;{{$year+1}}
      </button>
      <button class="btn btn-primary" id="today-fecha2">
      <span class="fa fa-calendar"></span>&nbsp;&nbsp;{{$year+2}}
      </button>

    </div>
  </div>

      <div class="col-md-6">
      <div class="row filtrado">
        <div class="col-md-6">
          <!--   <label for="fecha_inicio">FECHA: </label> -->
            <select  id="fecha_inicio" class="form-control"
              name="fecha_inicio" placeholder="Ingrese año">
              @foreach($anios as $anio)
                <option value="{{$anio}}" selected="">{{$anio}}</option>                  
              @endforeach             
            </select>
        </div>
        <div class="col-md-6 pull-right" >

         <input type="text" id="datepicker" autocomplete="off" />
        </div>
      </div>
    </div>
</div>