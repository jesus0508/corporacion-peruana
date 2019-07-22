<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de clientes - Table</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="tabla-clientes" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>RUC</th>
                <th>Razón Social</th>
                <th>Tipo</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($clientes as $cliente)
                <tr>
                  <td>{{$cliente->ruc}}</td>
                  <td>{{$cliente->razon_social}}</td>
                  <td>{{$cliente->tipo}}</td>
                  <td>{{$cliente->telefono}}</td>
                  <td>{{$cliente->direccion}}</td>
                  <td>
                    <button class="btn btn-info" data-toggle="modal" data-target="#modal-show-cliente"
                              data-id="{{$cliente->id}}" data-ruc="{{$cliente->ruc}}" data-tipo="{{$cliente->tipo}}"
                              data-razon_social="{{$cliente->razon_social}}" data-telefono="{{$cliente->telefono}}"
                              data-direccion="{{$cliente->direccion}}">
                      <span class="glyphicon glyphicon-eye-open"></span>
                    </button>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-cliente"
                              data-id="{{$cliente->id}}" data-ruc="{{$cliente->ruc}}" data-tipo="{{$cliente->tipo}}"
                              data-razon_social="{{$cliente->razon_social}}" data-telefono="{{$cliente->telefono}}"
                              data-direccion="{{$cliente->direccion}}">
                      <span class="glyphicon glyphicon-edit"></span>
                    </button>
                    <form style="display:inline" method="POST" action="{{ route('clientes.destroy', $cliente->id) }}">
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