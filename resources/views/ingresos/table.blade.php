<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de ingresos de los Grifos</h2>
        <div class="pull-right">
            <a href="#modal-create-ingreso" data-toggle="modal" data-target="#modal-create-ingreso" class="btn btn-primary">
              <i class="fa fa-plus"></i>
              Nuevo Ingreso
            </a>
            <a href="" class="btn btn-default">
              <i class="fa  fa-file-excel-o"></i>
              Exportar a Excel
            </a>
          </div>
      </div><!-- /.box-header -->
      <div class="box-body">
        @include('ingresos.opciones')
        <table id="tabla-ingreso_grifos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha Ingreso</th>
              <th>Lectura Inicial</th>
              <th>Lectura Final</th>
              <th>Calibracion</th>
              <th>Precio x Galon</th>
              <th>Grifo</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($ingresoGrifos as $ingresoGrifo)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$ingresoGrifo->fecha_ingreso}}</td>
                <td>{{$ingresoGrifo->lectura_inicial}}</td>
                <td>{{$ingresoGrifo->lectura_final}}</td>
                <td>{{$ingresoGrifo->calibracion}}</td>
                <td>{{$ingresoGrifo->precio_galon}}</td>
                <td>{{$ingresoGrifo->grifo->razon_social}}</td>
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