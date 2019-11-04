<div class="row">
  <!-- left column -->
  <form class="" action="{{route('factura_grifos.store')}}" method="post">
    @csrf
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Registrar facturación venta grifo</h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row" id="input_user_top">
            <div class="col-md-2">
              <div class="form-group @error('fecha') has-error @enderror">
                  <label for="fecha">Fecha Facturación*</label>
                  <input autocomplete="off" id="fecha" type="text" class="tuiker form-control" placeholder="Fecha facturación" 
                  name="fecha_facturacion"   required="" >
                  @error('fecha')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="grifo_id">Grifo</label>
                <select class="form-control" id="select_grifos" name="grifo_id" required>                                 
                </select>             
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="nro_serie">Número(s) de serie</label>
                <input id="nro_serie" type="text" class="form-control" 
                        readonly="" name="series">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="facturacion">Número(s) factura</label>
                <input id="facturacion" name="numero_factura" type="text" class="form-control" 
                        placeholder="Ingrese Números de facturas" readonly="" >
              </div>
            </div>
          </div>                    

          <div class="row" id="input_user">
            <div class="col-md-2">
              <div class="form-group">
                <label for="venta_factura">Venta Factura </label>
                <input id="venta_factura" type="number" step="any" min="0" class="form-control" 
                        placeholder="Venta factura"  name="venta_factura" readonly="">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="venta_boleta">Venta Boleta</label>
                <input id="venta_boleta" type="number" step="any" min="0" class="form-control" 
                        placeholder="Venta boleta" name="venta_boleta" readonly="" >
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="total_galones">Total galones </label>
                <input id="total_galones" type="text" class="form-control" 
                       readonly="">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="precio_galon">Precio Galon*</label>
                <input id="precio_galon" name="precio_venta" type="number"
                  step="any" min="1" class="form-control" placeholder="Precio galon" 
                  required="" readonly="">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="monto_total">Monto Total</label>
                <input id="monto_total" type="text" class="form-control" 
                        readonly="">
              </div>
            </div>  
            <div class="col-md-2">
              <div class="form-group">
                
              <button  type="submit" id="register" class="btn btn-lg btn-success pull-right" disabled="">
                <i class="fa fa-save"> </i>&nbsp;
                Registrar
                
              </button>
              </div>
              
            </div>                                  
          </div>        
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (left) -->
  </form>
</div> <!-- /.row-top -->


