<div class="row">
  <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      
    </div><!--/.col (left) -->
  
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box">
       <div class="box-header with-border">
          <h2 class="box-title">Datos Comprobación </h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group @error('linea_credito') has-error @enderror">
                <label for="codigo_operacion">Monto Total Ingresos Efectivo
                </label>
                <input id ="total_ingresos" style="color:blue; font-weight: bold;" type="text" class="form-control" readonly="" value="0.00">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('linea_credito') has-error @enderror">
                <label for="codigo_operacion">Monto Total Egresos Depósitos
                </label>
                <input id ="total_egresos" style="color:red; font-weight: bold;" type="text" class="form-control" readonly="" value="0.00">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('linea_credito') has-error @enderror">
                <label for="codigo_operacion">Monto a Comprobar
                </label>
                <input id ="monto_comprobacion" style="color:black; font-weight: bold;" type="text" class="form-control" readonly="" value="0.00" onchange='evaluarBtn()'>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group @error('linea_credito') has-error @enderror">
                <label for="codigo_operacion">Resta Comprobar</label>
                <input style="color: black; font-weight: bold;" id="restante_comprobacion" type="text" class="form-control" readonly="" value="0.00">
              </div>               
            </div>
          </div>        
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>

</div> <!-- /.row-top -->


