<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Lista de Grifos</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-grifos" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>RUC</th>
              <th>Razón Social</th>
              <th>Teléfono</th>
              <th>Administrador</th>
              <th>Stock</th>
              <th>Distrito</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($grifos as $grifo)
              <tr>
                <td>{{$grifo->ruc}}</td>
                <td>{{$grifo->razon_social}}</td>
                <td>{{$grifo->telefono}}</td>
                <td>{{$grifo->administrador}}</td>
                <td>{{$grifo->stock}}</td>
                <td>{{$grifo->distrito}}</td>
                <td>
                  <button class="btn btn-info" data-toggle="modal" data-target="#modal-show-grifo"
                            data-id="{{$grifo->id}}">
                    <span class="glyphicon glyphicon-eye-open"></span>
                  </button>
                  <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-grifo"
                            data-id="{{$grifo->id}}">
                    <span class="glyphicon glyphicon-edit"></span>
                  </button>
                  <form style="display:inline" method="POST" action="{{ route('grifos.destroy', $grifo->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->