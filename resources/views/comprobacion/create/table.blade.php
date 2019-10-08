<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-md-6">
            <h2 class="box-title">Lista comprobación </h2>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="">Fecha a filtrar </label>
              <input autocomplete="off" id="fecha_reporte2" type="text" class="tuiker form-control" name="fecha_reporte" placeholder="Fecha reporte" required="">
            </div>  
          </div>
          <div class="col-md-3">
            <button class="btn btn-info" id="btn_filter2"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp; Filtrar
            </button>
          </div>          
        </div>          
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-comprobaciones" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th width="15%">FECHA REPORTE</th>
              <th width="50%">Detalles</th>              
              <th width="15%"> Fecha</th>
              <th width="20%">Monto</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th colspan="3" style="text-align:right">Total:</th>
              <th></th>
            </tr>          
          </tfoot>
        </table>
      </div>
      <div class="box-footer">
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->