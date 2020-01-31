<div class="row">
  <div class="col-md-3">
    <div class="input-group">
      <span class="input-group-addon">Planta</span>
      <select class="form-control" id="filter-planta" name="planta_id">
        @foreach( $plantas as $planta )
          <option value="{{$planta->id}}">{{$planta->planta}}</option>
        @endforeach
      </select>
    </div><!-- /input-group -->
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <button class="btn btn-success" data-toggle="modal" data-target="#modal-pagar-proveedor">
               PAGAR   &nbsp;&nbsp; <span class="fa fa-money"></span>
      </button>

    </div>
  </div>

    <div class="col-md-7">
      <label for="">Filtrado por Fecha Factura</label>
      <div class="row filtrado">
        <div class="col-md-4">
          <div class="form-inline">
            <label for="fecha_inicio">Desde: </label>
            <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control"
              name="fecha_inicio" placeholder="Desde">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-inline">
            <label for="fecha_fin">Hasta: </label>
            <input autocomplete="off" id="fecha_fin" type="text" class="tuiker form-control"
              name="fecha_fin" placeholder="Final">
          </div>
        </div>
        <div class="col-md-4 pull-right" >
          <button id="filtrar-fecha" class="btn btn-sm btn-info">
            <i class="fa fa-search"></i>
            Filtrar
          </button>
          <button id="clear-fecha" class="btn btn-sm btn-danger">
            <i class="fa fa-remove "></i>
            Limpiar
          </button>
        </div>
      </div>
    </div>
        <!-- /.col -->

</div>