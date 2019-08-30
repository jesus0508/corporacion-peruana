<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de movimientos</h2>
        <div class="pull-right">
          <button id="btn-registrar_movimiento" data-toggle="modal" data-target="#modal-create-movimiento" class="btn btn-primary" >
            <i class="fa fa-plus"> </i>
            Registrar movimiento
          </button>
          <a href="{{route('movimientos.validar')}}" id="btn-registrar_movimiento" class="btn btn-success" >
            <i class="fa fa-check"> </i>
            Verificar movimientos
          </a>
          <a href="" class="btn btn-default">
            <i class="fa  fa-file-excel-o"></i>
            Exportar a Excel
          </a>
        </div>
      </div><!-- /.box-header -->
      <div class="box-body">
        @include('movimientos.opciones')
        <table id="tabla-movimientos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha Operacion</th>
              <th>Codigo Operacion</th>
              <th>Abono</th>
              <th>Banco</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($movimientos as $movimiento)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{date('d/m/Y', strtotime($movimiento->fecha_operacion))}}</td>
              <td>{{$movimiento->codigo_operacion}}</td>
              <td>S/&nbsp;{{$movimiento->monto_operacion}}</td>
              <td>{{$movimiento->banco}}</td>
              <td>
                @if($movimiento->estado == 3)
                <span class="label label-success">
                @elseif ($movimiento->estado == 2)
                <span class="label label-warning">
                @else 
                <span class="label label-info">
                @endif
                {{$movimiento->getEstado()}}
                </span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="box-footer">
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->