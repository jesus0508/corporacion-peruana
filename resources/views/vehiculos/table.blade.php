<div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de Vehiculos</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="tabla-vehiculos" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nro</th>
                <th>Placa </th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($vehiculos as $vehiculo)
                <tr>
                	<td>{{$vehiculo->id}}</td>
                  <td>{{$vehiculo->placa}}</td>
                  <td>{{$vehiculo->modelo}}</td>
                  <td>{{$vehiculo->marca}}</td>

                  @include('actions.vehiculo')

                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->