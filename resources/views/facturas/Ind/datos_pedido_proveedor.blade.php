<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Datos Pedido Proveedor</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="nro_pedido">Pedido</label>
            <input id="nro_pedido" type="text" class="form-control" 
                          name="nro_pedido" value="{{$pedido->nro_pedido}}" readonly>
        </div>
        <input type="hidden" value="{{ $pedido->id }}" name="id_pedido">
      </div><!-- end razon -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="scop">SCOP pedido</label>
          <input id="scop" type="text" class="form-control" 
                          name="scop" value="{{$pedido->scop}}" readonly>
        </div>
      </div><!-- end ruc -->
    </div>
  </div><!-- /.box-body -->
</div><!-- /.box datos pedido -->