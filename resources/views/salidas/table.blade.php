<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-md-3">
            <h2 class="box-title">Lista de últimos 100 Egresos</h2>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="">Fecha a filtrar</label>
              <input autocomplete="off" id="fecha_inicio" type="text" class="form-control"  placeholder="Fecha ingreso">
            </div>  
          </div>
          <div class="col-md-4">
            <button class="btn btn-info" id="filtrar-fecha"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp; Filtrar</button>
            <button id="clear-fecha" class="btn btn-danger">
              <i class="fa fa-remove "></i>
              Limpiar
            </button>
          </div>      
        </div>    
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-egresos" class="table table-bordered table-striped display nowrap" >
          <thead>
            <tr>
              <th>Fecha Reporte</th>
              <th>Fecha Egreso</th>              
              <th>Detalles</th>
              <th>N° de cheque</th>
              <th>N° de operacion</th>
              <th>Cuenta</th>
              <th>Monto</th>
            </tr>
          </thead>
          <tbody>         
            @foreach($salidas as $salida)
              <tr>
                <td>{{$salida->fecha_reporte}}</td>
                <td>{{$salida->fecha_egreso}}</td>
                <td>{{$salida->detalle}}</td>
                <td>{{$salida->nro_cheque}}</td>
                <td>{{$salida->codigo_operacion}}</td>
                <td>{{$salida->cuenta->nro_cuenta}}</td>
                <td>{{$salida->monto_egreso}}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      <div class="box-footer">
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->