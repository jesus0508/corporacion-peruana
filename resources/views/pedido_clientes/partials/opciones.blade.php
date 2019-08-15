<div class="row">
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">Cliente</span>
      <select class="form-control" id="filter-cliente" name="cliente_id">
        @foreach ( $clientes as $cliente)
          <option value="{{$cliente->id}}">{{$cliente->razon_social}}</option>
        @endforeach
      </select>
    </div><!-- /input-group -->
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <button id="btn-pagar" data-toggle="modal" data-target="#modal-create-pago_bloque" class="btn btn-success" >
        <i class="fa fa-money"> </i>
        Pagar en Bloque
      </button>
    </div>
  </div>
</div>