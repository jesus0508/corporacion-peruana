<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Lista de trabajadores</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-trabajadores" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>DNI</th>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Fecha de Nacimiento</th>
              <th>Telefono</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($trabajadores as $trabajador)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$trabajador->dni}}</td>
                <td>{{$trabajador->nombres}}</td>
                <td>{{$trabajador->apellido_paterno}}</td>
                <td>{{date('d/m/Y', strtotime($trabajador->fecha_nacimiento))}}</td>
                <td>{{$trabajador->telefono}}</td>
                <td>
                  <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-show-trabajador"
                            data-id="{{$trabajador->id}}">
                    <span class="glyphicon glyphicon-eye-open"></span>
                  </button>
                  <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-edit-trabajador"
                            data-id="{{$trabajador->id}}">
                    <span class="glyphicon glyphicon-edit"></span>
                  </button>
                  <form style="display:inline" method="POST" action="{{ route('trabajadores.destroy', $trabajador->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                  </form>
                  @if(!$trabajador->hasAccount())
                  <button class="btn bg-purple btn-xs" data-toggle="modal" data-target="#modal-create-user"
                    data-trabajador_id="{{$trabajador->id}}">
                    <span class="fa fa-fw fa-user-plus"></span>
                  </button>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->