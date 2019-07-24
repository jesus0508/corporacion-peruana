<div class="modal fade" id="modal-confirmar-pedido" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('pedido_clientes.procesarPedido')}}" method="post" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Confirmar Pedido</h4>
        <h3> <span class="label label-danger text-center"> Si confirma este pedido, ya no podrá eliminarlo luego!</span></h3>
      </div>
        <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"> PROCESAR PEDIDO</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="horario_descarga-confirmar">Horario para descarga</label>
                  <input id="horario_descarga-confirmar" type="text" class="form-control"
                          name="horario_descarga" placeholder="Ingrese el horario para descarga">
                </div>
                <div class="form-group">
                  <label for="chofer-confirmar">Nombre del chofer</label>
                  <input id="chofer-confirmar" type="text" class="form-control" 
                          name="chofer" placeholder="Ingrese el nombre del chofer">
                </div>
                <div class="form-group">
                  <label for="codigo_chofer-confirmar">Codigo del chofer</label>
                  <input id="codigo_chofer-confirmar" type="text" class="form-control" 
                          name="codigo_chofer" placeholder="Ingrese el codigo del chofer">
                </div>
                <div class="form-group">
                  <label for="planta">Placa Chofer</label>
                  <select class="form-control" name="planta" id="planta">
                    <option>Traer de la bd</option>
                    <option>Traer de la bd</option>
                    <option>Traer de la bd</option>
                    <option>Traer de la bd</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="usuario_osinerming-confirmar">Usuario Osinerming</label>
                  <input id="usuario_osinerming-confirmar" type="text" class="form-control"
                            name="usuario_osinerming" placeholder="Ingrese el usuario Osinerming">
                </div>
                <div class="form-group">
                  <label for="observacion-confirmar">Observacion</label>
                  <textarea id="observacion-confirmar" type="text" class="form-control"
                            name="observacion" placeholder="Ingrese alguna observacion imporante"></textarea>
                </div>
                <input id="id-confirmar" type="hidden" name="id">
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
        </div> 
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left">REALIZAR OPERACION</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>