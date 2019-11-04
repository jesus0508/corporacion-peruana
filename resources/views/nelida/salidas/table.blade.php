<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Lista de Transporte</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-clientes" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              {{--La fecha de reporte y Alquiler de Buses de titulo en el excel--}}
              <th>fecha de ingreso</th>
              <th>Placa</th>
              <th>Comprobante</th>
              <th>N° comprobante</th>
              <th>descripccion</th>
              <th>Monto</th>  
              <th>Acciones</th>
              
            </tr>
          </thead>
          <tbody>
            @foreach ($transportes as $cliente)
              <tr>
                <td>{{$cliente->ruc}}</td>
                <td>{{$cliente->razon_social}}</td>
                <td>{{$cliente->telefono}}</td>
                <td>{{$cliente->direccion}}</td>
                <td>
                  <button class="btn btn-info" data-toggle="modal" data-target="#modal-show-cliente"
                            data-id="{{$cliente->id}}">
                    <span class="glyphicon glyphicon-eye-open"></span>
                  </button>
                  <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-cliente"
                            data-id="{{$cliente->id}}">
                    <span class="glyphicon glyphicon-edit"></span>
                  </button>
                  @if($cliente->pedidoClientes->isEmpty())
                    <form style="display:inline" method="POST" action="{{ route('clientes.destroy', $cliente->id) }}">
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