<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Últimos 100 ingresos registrados</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-ingresos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>FECHA REPORTE</th>
              <th>Fecha Ingreso</th>
              <th>Detalle</th>
              <th>Banco</th>
              <th>CODIGO OPERACION</th>
              <th>MONTO</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($ingresos as $ingreso)
              <tr>
                <td> {{$ingreso->fecha_reporte}}          </td>
                <td> {{$ingreso->fecha_ingreso}}          </td>
                <td> {{$ingreso->detalle}}     </td>
                <td> {{$ingreso->banco}}                </td>
                <td> {{$ingreso->codigo_operacion}}       </td>
                <td> {{$ingreso->monto_ingreso}}                  </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->