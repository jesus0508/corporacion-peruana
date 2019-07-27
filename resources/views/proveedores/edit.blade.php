 @if(!empty($id))

<div class="modal fade" id="modal-edit-proveedor" style="display: none;">
  <div class="modal-dialog" style="width: 500px;">
 

    <form action="{{route('proveedores.update',0)}}" method="post" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos del proveedor</h4>
        <input id="id-edit" type="hidden" name="id">
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
              
                <div class="form-group">
                  <label for="razon_social-edit">Razon Social</label>
                  <input id="razon_social-edit" type="text" class="form-control" value=""
                          name="razon_social" placeholder="Ingrese la Razon Social" required>
                </div>

                <div class="form-group">
                  <label for="ruc-edit">RUC</label>
                  <input id="ruc-edit" type="text" class="form-control" value=""
                          name="ruc" placeholder="Ingrese el RUC" required>
                </div>

                
               

              
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos secundarios</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                
                <div class="form-group">
                  <label for="representante-edit">Representante</label>
                  <input id="representante-edit" type="text" class="form-control" 
                          name="representante" placeholder="Ingrese el nombre del representante">
                </div>
                
                
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (right) -->
        </div> 
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success pull-left">Guardar cambios</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
@endif