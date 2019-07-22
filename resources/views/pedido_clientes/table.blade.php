<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de pedidos - Table</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="tabla-pedido_clientes" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nro Pedido</th>
                <th>Scop</th>
                <th>Grifo</th>
                <th>Planta</th>
                <th>Horario</th>
                <th>Observacion</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pedido_clientes as $pedido_cliente)
                <tr>
                  <td>{{$pedido_cliente->nro_pedido}}</td>
                  <td>{{$pedido_cliente->scop}}</td>
                  <td>{{$pedido_cliente->grifo}}</td>
                  <td>{{$pedido_cliente->planta}}</td>
                  <td>{{$pedido_cliente->horario_descarga}}</td>
                  <td>{{$pedido_cliente->observacion}}</td>
                  <td>
                    <button class="btn btn-info" data-toggle="modal" data-target="#modal-show-pedido_cliente"
                            data-id="{{$pedido_cliente->id}}" data-nro_pedido="{{$pedido_cliente->nro_pedido}}" data-grifo="{{$pedido_cliente->grifo}}"
                            data-planta="{{$pedido_cliente->planta}}" data-scop="{{$pedido_cliente->scop}}" data-horario_descarga="{{$pedido_cliente->horario_descarga}}"
                            data-observacion="{{$pedido_cliente->observacion}}">
                      <span class="glyphicon glyphicon-eye-open"></span>
                    </button>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-pedido_cliente"
                            data-id="{{$pedido_cliente->id}}" data-nro_pedido="{{$pedido_cliente->nro_pedido}}" data-grifo="{{$pedido_cliente->grifo}}"
                            data-planta="{{$pedido_cliente->planta}}" data-scop="{{$pedido_cliente->scop}}" data-horario_descarga="{{$pedido_cliente->horario_descarga}}"
                            data-observacion="{{$pedido_cliente->observacion}}">
                      <span class="glyphicon glyphicon-edit"></span>
                    </button>
                    <form style="display:inline" method="POST" action="{{ route('pedido_clientes.destroy', $pedido_cliente->id) }}">
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