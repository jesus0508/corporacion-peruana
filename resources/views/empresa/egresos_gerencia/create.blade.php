<div class="row">
  <!-- left column -->
  <form action="{{route('egreso_gerencia.store')}}" method="POST">
    @csrf
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Datos del Gasto</h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group @error('fecha') has-error @enderror">
                <label for="fecha">Fecha*</label>
                <input autocomplete="off" id="fecha" type="text" class="form-control" required="" value="{{old('fecha')}}" 
                name="fecha" placeholder="Ingrese la fecha ">
                @error('fecha')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group @error('nombre') has-error @enderror">
                <label for="nombre">Nombre y/o Razon Social*</label>
                <select id="nombre" class="form-control" name="nombre"  required="">                      
                  <option value="1">Familia</option>
                  <option value="2">Corporacion</option>

                </select>
              </div>
            </div>
          <div class="col-md-6">
              <div class="form-group @error('concepto') has-error @enderror">
                <label for="concepto">Concepto*</label>
                <input id="concepto" type="text" class="form-control" required="" value="{{old('concepto')}}" 
                name="concepto" placeholder="Ingrese el concepto ">
                @error('concepto')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
          </div>
   
          <div class="col-md-3">
            <div class="form-group @error('comprobante_pago') has-error @enderror">
              <label for="comprobante_pago">Tipo Comprobante*</label>
              <select id="comprobante_pago" class="form-control" name="comprobante_pago"  required="">                      
                <option value="1">Sin Comprobante</option>
                <option value="2">Recibo</option>
                <option value="1">Factura</option>
                <option value="2">Boleta de Venta</option>                                

              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group @error('monto') has-error @enderror">
              <label for="monto">Monto*</label>
              <input  id="monto" type="text" class="form-control" required="" value="{{old('monto')}}" 
              name="monto" placeholder="Ingrese el monto ">
              @error('monto')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>        
             <div class="col-md-6">
                <div class="form-group">
                  <br>
                  <button class="btn form-control btn-success">
                  <i class="fa fa-save"> </i>
                   Registrar Egreso
                  </button>
                </div>
            </div>
          </div>          
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (left) -->  
  </form>   
</div> <!-- /.row-top -->
