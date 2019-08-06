<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de usuarios</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="tabla-users" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Fecha de Nacimiento</th>
                <th>Telefono</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$user->nombres}}</td>
                  <td>{{$user->apellido_paterno}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->fecha_nacimiento}}</td>
                  <td>{{$user->telefono}}</td>
                  <td>
                    <button class="btn btn-info" data-toggle="modal" data-target="#modal-show-user"
                              data-id="{{$user->id}}" data-nombres="{{$user->nombres}}" data-apellido_paterno="{{$user->apellido_paterno}}"
                              data-apellido_materno="{{$user->apellido_materno}}" data-password="{{$user->password}}"
                              data-email="{{$user->email}}" data-fecha_nacimiento="{{$user->fecha_nacimiento}}"
                              data-telefono="{{$user->telefono}}">
                      <span class="glyphicon glyphicon-eye-open"></span>
                    </button>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-user"
                              data-id="{{$user->id}}" data-nombres="{{$user->nombres}}" data-apellido_paterno="{{$user->apellido_paterno}}"
                              data-apellido_materno="{{$user->apellido_materno}}" data-password="{{$user->password}}"
                              data-email="{{$user->email}}" data-fecha_nacimiento="{{$user->fecha_nacimiento}}"
                              data-telefono="{{$user->telefono}}">
                      <span class="glyphicon glyphicon-edit"></span>
                    </button>
                    <form style="display:inline" method="POST" action="{{ route('users.destroy', $user->id) }}">
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