<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <div class="col-md-2">
          <div class="form-group">
            <label for="">Fecha: </label>
            <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control" name="fecha_inicio" placeholder="Fecha reporte" value="{{$today}}" required="">
          </div>            
        </div>
        <div class="col-md-5">
          <div class="row filtrado">
            <div class="col-md-6" >
              <button id="filtrar-fecha" class="btn btn-info">
                <i class="fa fa-search"></i>
                Filtrar
              </button>
              <button id="clear-fecha" class="btn btn-danger">
                <i class="fa fa-remove "></i>
                Limpiar
              </button>
            </div>
          </div>
        </div>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-depositos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>FECHA REPORTE</th>
              <th>NUMERO DE CUENTA</th>
              <th>DETALLES</th>
              <th>CODIGO OPERACION</th>
              <th>MONTO</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->