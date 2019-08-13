<div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">LISTA DE <b>TRANSPORTISTAS </b></h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="tabla-transportistas" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th width="25%">Transportista </th>
                <th width="20%">RUC</th>
                <th width="25%">Celular</th>
                <th width="25%">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transportistas_tbl as $transportista)
                <tr>
                	<td>{{$transportista->id}}</td>
                  <td>{{$transportista->nombre_transportista}}</td>
                  <td>{{$transportista->ruc}}</td>
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