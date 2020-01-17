<div class="modal fade" id="modal-agregar_factura" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('pedido_clientes.agregarFactura',0)}}" method="post" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Agregar Factura al Pedido Cliente</h4>
        
      </div>
        <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"> AGREGAR FACTURA </h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nro_factura-agregar">Numero Factura</label>
                      <input id="nro_factura-agregar" type="text" class="form-control"
                              name="nro_factura" placeholder="Ingrese el numero de factura" autocomplete="off">
                    </div> 
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="fecha_factura-agregar">Fecha Factura</label>
                      <input id="fecha_factura-agregar" type="text" class="form-control" 
                              name="fecha_factura" placeholder="Ingrese la fecha de la factura" autocomplete="off">
                    </div>
                  </div>                  
                </div>
                <input id="id-agregar" type="hidden" name="id">
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
        </div> 
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success pull-left">Confirmar</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>