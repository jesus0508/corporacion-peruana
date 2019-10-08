<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-md-3">
            <h2 class="box-title">Lista de Egresos</h2>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="">Fecha a filtrar</label>
              <input autocomplete="off" id="fecha_reporte2" type="text" class="tuiker form-control" name="fecha_reporte" placeholder="Fecha reporte" required="">
            </div>  
          </div>
          <div class="col-md-3">
            <button class="btn btn-info" id="btn_filter2"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp; Filtrar</button>
          </div>          
        </div>    
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-egresos" class="table table-bordered table-striped responsive display nowrap" >
          <thead>
            <tr>
              <th>FECHA REPORTE</th>
              <th>CATEGORIA</th>              
              <th>Detalles</th>
              <th>FECHA egreso</th>
              <th>Extra Info</th>
              <th>Monto</th>
            </tr>
          </thead>
        </table>
      </div>
      <div class="box-footer">
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->