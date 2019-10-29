<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Lista de depósitos</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-clientes" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha Depósito </th>
              <th>Número de Operacion Depósito</th>
              <th>Monto Depósito</th>
            <!--   <th>Acciones</th> -->
            </tr>
          </thead>
          <tbody>
            @foreach ($cancelaciones as $cliente)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$cliente->fecha}}</td>
                <td>{{$cliente->nro_operacion}}</td>
                <td>{{$cliente->monto}}</td>
<!--                 <td>
                  <button class="btn btn-info" data-toggle="modal" data-target="#modal-show-cliente"
                            data-id="{{$cliente->id}}">
                    <span class="glyphicon glyphicon-eye-open"></span>
                  </button>
                </td> -->
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->