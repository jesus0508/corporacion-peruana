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
                <th width="2%">#</th>
                <th width="20%">Placa </th>
                <th width="15%">Capacidad</th>
                <th width="45%">Detalle Compartimiento</th>
                <th width="15%">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($vehiculos as $vehiculo)
                <tr>
                	<td>{{$vehiculo->id}}</td>
                  <td>{{$vehiculo->placa}}</td>
                  <td>{{$vehiculo->capacidad}}&nbsp;galones</td>
                  <td>
                    <?php 
                     $string = $vehiculo->detalle_compartimiento;
                     echo nl2br($string);
                    ?>                    
                  </td>

                  @include('actions.vehiculo')

                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->