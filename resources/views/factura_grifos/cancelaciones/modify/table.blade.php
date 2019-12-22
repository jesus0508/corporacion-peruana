<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Cancelaciones</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-cancelaciones-modify" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha Facturación</th>
              <th>Grifo</th>
              <th>Fecha Depósito </th>
              <th>Número de Operacion Depósito</th>
              <th>Monto Depósito</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cancelaciones as $cancelacion)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{date('d/m/Y', 
                strtotime($cancelacion->facturacionGrifo->fecha_facturacion))}}</td>
                <td>{{$cancelacion->facturacionGrifo->grifo->razon_social}}</td>
                <td>{{date('d/m/Y', 
                strtotime($cancelacion->fecha))}}</td>
                <td>{{$cancelacion->nro_operacion}}</td>
                <td>{{$cancelacion->monto}}</td>
                <td>
                  <btn class="btn btn-xs btn-warning" 
                      href="#modal-edit-cancelacion"  
                      data-toggle="modal" data-target=" #modal-edit-cancelacion"
                      data-id="{{$cancelacion->id}}">
                      <span class="glyphicon glyphicon-edit"></span>
                      &nbsp; Editar                     
                  </btn>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->