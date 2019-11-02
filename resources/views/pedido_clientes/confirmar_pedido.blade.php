<div class="modal fade" id="modal-confirmar_pedido" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('pedido_clientes.confirmarPedido',0)}}" method="post" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Confirmar Pedido</h4>
        
      </div>
        <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"> CONFIRMAR PEDIDO</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <h3 class="text-center"> <span class="label label-danger"> Si confirma este pedido, ya no podrá eliminarlo luego!</span></h3>
                <input id="id-confirmar" type="hidden" name="id">
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
        </div> 
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left">Confirmar</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>