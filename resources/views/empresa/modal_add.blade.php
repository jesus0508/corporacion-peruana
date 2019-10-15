<div class="modal fade" id="modal-add-banco" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('bancos.store')}}" method="post" class="modal-content">
      @csrf
      <input type="hidden" name="empresa_id" value="1">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Agregar Banco</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="banco-add">Nombre Banco</label>
                  <input id="banco-add" type="text" class="form-control"
                        name="banco" placeholder="Ingrese el nombre del banco" required>
                </div>
                <div class="form-group">
                  <label for="abreviacion-add">Abreviación Banco</label>
                  <input id="abreviacion-add" type="text" class="form-control" 
                          name="abreviacion" placeholder="Ingrese la abreviacion" required>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (right) -->
        </div>       
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success pull-left">Añadir</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
