<div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de transportistas - Table</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="tabla-transportistas" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nro</th>
                <th>Nombre </th>
                <th>Brevete</th>
                <th>Celular</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transportistas_tbl as $transportista)
                <tr>
                	<td>{{$transportista->id}}</td>
                  <td>{{$transportista->nombre_transportista}}</td>
                  <td>{{$transportista->brevete}}</td>
                  <td>{{$transportista->celular_transportista}}</td>

                  @include('actions.transportista')

                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->