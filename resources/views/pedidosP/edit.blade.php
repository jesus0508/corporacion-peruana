<div class="modal fade" id="modal-edit-pedido-proveedor" style="display: none;">
  <div class="modal-dialog">


    <form action="{{route('pedidos.update',0)}}" method="post" class="modal-content">
     @csrf
      @method('PUT')
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos del pedido</h4>
        <input type="hidden" id="id_pedido" name="id">
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
                <div class="form-group @error('nro_pedido') has-error @enderror">
                  <label for="nro_pedido-edit">Número de pedido</label>
                  <input id="nro_pedido-edit" type="text" class="form-control" name="nro_pedido" placeholder="Ingrese el número de pedido" min="0" required>
                  @error('nro_pedido')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group @error('scop') has-error @enderror">
                  <label for="scop-edit">SCOP </label>
                  <input id="scop-edit" type="text" class="form-control" name="scop" placeholder="Ingrese el SCOP" min="0" required>
                  @error('scop')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
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
                
                 <div class="form-group @error('galones') has-error @enderror">
                  <label for="galones-edit"> Galones  </label>
                  <input id="galones-edit" type="number" class="form-control" name="galones" placeholder="Ingrese cantidad de galones" min="0" max="99999" required>
                   @error('galones')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                 <div class="form-group @error('costo_galon') has-error @enderror">
                  <label for="costo_galon-edit"> Costo galón  </label>
                  <input id="costo_galon-edit" type="text" class="form-control" name="costo_galon" placeholder="Ingrese el precio del galón" pattern="(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{5}))?)" title="Formato: Use 5 decimales" required>
                  @error('costo_galon')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
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