<div class="row">
  <div class="col-md-4">
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
</div>