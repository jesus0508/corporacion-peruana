<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Lista de Transporte</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-transporte" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Tipo</th>
              <th>Placa</th>
              <th>Chofer</th>
              <th>Acciones</th>
              
            </tr>
          </thead>
          <tbody>
            @foreach ($transportes as $transporte)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$transporte->getTipo()}}</td>
                <td>{{$transporte->placa}}</td>
                <td>{{$transporte->chofer}}</td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-transporte"
                            data-id="{{$transporte->id}}">
                    <span class="glyphicon glyphicon-edit"></span>
                  </button>
                  <form style="display:inline" method="POST" action="{{ route('transporte.destroy', $transporte->id) }}">
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