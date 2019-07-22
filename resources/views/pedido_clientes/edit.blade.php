<div class="modal fade" id="modal-edit-pedido_cliente" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('pedido_clientes.update',0)}}" method="post" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos del cliente</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Formulario</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="nro_pedido-edit">Número de Pedido</label>
                  <input id="nro_pedido-edit" type="text" class="form-control" 
                          name="nro_pedido" placeholder="Ingrese el numero de pedido">
                </div>
                <div class="form-group">
                  <label for="scop-edit">SCOP</label>
                  <input id="scop-edit" type="text" class="form-control"
                          name="scop" placeholder="Ingrese el SCOP">
                </div>
                <div class="form-group">
                  <label for="grifo-edit">Grifo</label>
                  <input id="grifo-edit" type="text" class="form-control" 
                          name="grifo" placeholder="Ingrese el nombre del Grifo">
                </div>
                <div class="form-group">
                  <label for="galones-edit">Galones</label>
                  <input id="galones-edit" type="number" class="form-control" 
                          name="galones" placeholder="Ingrese el numero de galones">
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"></h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="planta-edit">Planta</label>
                  <select class="form-control" name="planta" id="planta-edit">
                      <option>Pampilla</option>
                      <option>Callao</option>
                      <option>PBF</option>
                      <option>Conchan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="horario_descarga-edit">Horario para descarga</label>
                  <input id="horario_descarga-edit" type="text" class="form-control"
                          name="horario_descarga" placeholder="Ingrese el horario para descarga">
                </div>
                <div class="form-group">
                  <label for="observacion-edit">Observacion</label>
                  <textarea id="observacion-edit" type="text" class="form-control"
                          name="observacion" placeholder="Ingrese alguna observacion imporante"></textarea>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (right) -->
          <input id="id-edit" type="hidden" name="id">
        </div> <!-- /.row-top -->
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left">Guardar cambios</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
  