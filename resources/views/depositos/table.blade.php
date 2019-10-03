<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Lista de depositos </h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-clientes" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>NUMERO DE CUENTA</th>
              <th>DETALLES</th>
              <th>CODIGO OPERACION</th>
              <th>MONTO</th>
              <th>FECHA REPORTE</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($depositos as $deposito)
              <tr>
                <td>{{$deposito->cuenta->nro_cuenta}}</td>
                <td>{{$deposito->detalle}}</td>
                <td>{{$deposito->codigo_operacion}}</td>
                <td>{{$deposito->monto}}</td>
                <td>  {{$deposito->fecha_reporte}}                
                  
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->