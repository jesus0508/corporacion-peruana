 @if(!empty($pedido))

<div class="modal fade" id="modal-edit-pedido-proveedor" style="display: none;">
  <div class="modal-dialog">
 

    <form action="{{route('pedidos.update',$pedido->id)}}" method="post" class="modal-content">
     @csrf
      @method('PUT')
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos del pedido</h4>
      </div>

        <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Datos principales</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="nro_pedido-edit">Número de pedido</label>
                  <input id="nro_pedido-edit" type="text" class="form-control" name="nro_pedido" placeholder="Ingrese el número de pedido">
                </div>
                <div class="form-group">
                  <label for="scop-edit">SCOP </label>
                  <input id="scop-edit" type="text" class="form-control" name="scop" placeholder="Ingrese el SCOP">
                </div>

                <div class="form-group">
                  <label for="planta" > Planta </label>
                  <select class="form-control" id="planta-edit" style="width: 100%;" name="planta_id">
                    @foreach ( $plantas as $planta)
                      <option value="{{$planta->id}}">{{$planta->planta}}</option>
                    @endforeach
                  </select>
                </div>



              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"> DIESEL B5 (S50) UV</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                
                 <div class="form-group">
                  <label for="galones-edit"> Galones  </label>
                  <input id="galones-edit" type="text" class="form-control" name="galones" placeholder="Ingrese cantidad de galones">
                </div>

                 <div class="form-group">
                  <label for="costo_galon-edit"> Costo galón  </label>
                  <input id="costo_galon-edit" type="text" class="form-control" name="costo_galon" placeholder="Ingrese el precio del galón">
                </div>

                <div class="form-group">
                  <label for="monto_total"> Monto Total </label>
                  <input id="monto_total" type="text" class="form-control" name="monto_total" placeholder="Ingrese el precio del galón" disabled>
                </div>
            
            
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (right) -->
        </div> 
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left">Guardar cambios</button>
        <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>
@endif

