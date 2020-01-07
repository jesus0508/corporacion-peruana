<div class="modal fade" id="modal-registrar-faltante" style="display: none;">
  <div class="modal-dialog">
    <form action="{{route('flete.update',0)}}" method="post" class="modal-content">
      @csrf
      @method('PUT')
      <input id="id_pivote" type="hidden" name="id">
      <input type="hidden" id="pedido_cliente_id" name="pedido_cliente_id">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Registrar Faltante | TIPO: <input class="" type="text" id="tipo" disabled=""></h4>
      </div>
        <div class="modal-body">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"> REGISTAR FALTANTE | Transportista: &nbsp; <input class="" type="text" id="transportista" disabled=""></h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group @error('faltante') has-error @enderror">
                      <label for="faltante"> Faltante*</label>
                      <input id="faltante" type="number" class="form-control"
                          name="faltante" min="1" max="9999" placeholder="Ingrese los galones faltantes.." autocomplete="off">
                      @error('faltante')
                        <span class="help-block" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div> 
                  <div class="col-md-6"> 
                    <div class="form-group">
                      <label for="grifero">Grifero</label>
                      <input id="grifero" type="text" class="form-control" 
                          name="grifero" placeholder="Ingrese el grifero" autocomplete="off">
                    </div>             
                  </div> 
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="descripcion"> Descripcion</label>
                      <input id="descripcion" type="text" class="form-control" 
                          name="descripcion" placeholder="Ingrese la descripción..">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                   <div class="form-group">
                      <label for="">GRIFO</label>
                      <input id="razon_social" type="text" class="form-control"
                              readonly="">
                    </div>
                    <input type="hidden" name="grifo_id" id="grifo_id">
                    <div class="form-group">
                      <label for="costo_galon-edit">Costo Galon</label>
                      <input id="costo_galon-edit" type="text" class="form-control"
                            name="precio_galon_faltante" >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="fecha_descarga">Fecha Descarga</label>
                      <input id="fecha_descarga" type="text" class="form-control"
                             readonly="">
                    </div>  
                    <div class="form-group">
                      <label for="monto_descuento">Monto Descuento</label>
                      <input id="monto_descuento" type="text" class="form-control" 
                            name="monto_descuento" readonly="">
                    </div>
                  </div>                          
                </div> <!--End - row -->
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!--/.col (left) -->
        </div> 
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn-lg btn-success pull-left">Guardar</button>
        <button type="" class="btn-lg btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form><!-- /.form-modal-content -->
  </div><!-- /.modal-dialog -->
</div>