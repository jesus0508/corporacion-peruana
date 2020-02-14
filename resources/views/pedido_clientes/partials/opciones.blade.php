<div class="row">
  <div class="col-md-8">
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

  </div>
</div>
<br>