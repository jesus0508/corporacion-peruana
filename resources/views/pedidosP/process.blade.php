 @if(!empty($pedido))

<div class="modal fade" id="modal-process-pedido" style="display: none;">
  <div class="modal-dialog">
 

    <form action="{{route('pedidos.show',$pedido->id)}}" method="GET" class="modal-content">
      @csrf
      @method('GET')
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">processar datos del pedido</h4>
        <h3> <span class="label label-danger"> Si procesa este pedido, ya no podrá eliminarlo luego!</span></h3>
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
                  <label for="costo_total-process"> MONTO TOTAL   </label>
                  <input id="costo_total-process" type="text" class="form-control" name="costo_total" disabled>
                </div>
                <div class="form-group">
                  <label for="saldo-process">MONTO PAGADO </label>
                    <input id="saldo-process" type="text" class="form-control" name="monto_pago" style=" font-weight: bold; color: red;">
                </div>

               


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
@endif