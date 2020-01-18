<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de pagos de cliente</h2>
      </div><!-- /.box-header -->
      <div class="box-body">
        @include('pago_clientes.opciones')
        <table id="tabla-pagos" class="table table-bordered table-striped responsive display " style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha Operacion</th>
              <th>Fcha Ingreso</th>
              <th>Codigo Operacion</th>
            {{--   <th>Nro Factura</th> --}}
              <th>Banco</th>
              <th>Cliente</th>
              <th>Abono</th>
              <th>Acción</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($pagos as $pago)
              <tr> 
                <td>{{$loop->iteration}}</td>             
                <td>{{date('d/m/Y', strtotime($pago->fecha_operacion))}}</td>
                <td>{{date('d/m/Y', strtotime($pago->fecha_reporte))}}</td>
                <td>{{$pago->codigo_operacion}}</td>
          {{--  @if($pago->factura_cliente_id!=null)
                  <td>{{$pago->nro_factura}}</td>
                @else
                  <td>Sin factura</td>
                @endif --}}
                <td>{{$pago->banco}}</td>
                <td>{{$pago->razon_social}}</td>
                <td>S/&nbsp;{{$pago->monto_operacion}}</td>
                <td>
                  <a href="{{ route('pago_clientes.show', $pago->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>&nbsp;&nbsp;Detalles</a>
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