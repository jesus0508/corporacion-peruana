<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Lista de clientes</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-clientes" class="table table-bordered table-striped responsive display" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>RUC</th>
              <th>Razón Social</th>
              <th>Teléfono</th>
              <th>Dirección</th>
              <th>Correo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($clientes as $cliente)
              <tr>
                <td>{{$cliente->ruc}}</td>
                <td>{{$cliente->razon_social}}</td>
                <td>{{$cliente->telefono}}</td>
                <td>{{$cliente->direccion}}</td>
                <th>{{$cliente->correo_cliente}}</th>
                <td>
                  <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal-show-cliente"
                            data-id="{{$cliente->id}}">
                    <span class="glyphicon glyphicon-eye-open"></span>
                  </button>
                  <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-edit-cliente"
                            data-id="{{$cliente->id}}">
                    <span class="glyphicon glyphicon-edit"></span>
                  </button>
                  @if($cliente->pedidoClientes->isEmpty())
                    <form style="display:inline" method="POST"  onsubmit="return confirmar()" action="{{ route('clientes.destroy', $cliente->id) }}">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
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