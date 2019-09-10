<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de Pedidos de Clientes Distribuidos</h2>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-pedido_clientes_res" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>Fecha de Pedido</th>
              <th>Cliente</th>
              <th>Cantidad GLS</th>
              <th>Galones Asignados</th>
              <th>Acciones</th>


            </tr>
          </thead>
          <tbody>
            @foreach ($pedidos_cl as $pedido_cliente)
              <tr>
                <td>{{date('d/m/Y', strtotime($pedido_cliente->created_at))}}</td>
                <td>{{$pedido_cliente->cliente->razon_social}}</td>
                <td>{{$pedido_cliente->galones}}</td>
                <td>{{$pedido_cliente->asignacion}}</td>
                <td> 
                    <a class="btn btn-primary" href="{{route('pedido_clientes.detalles',$pedido_cliente->id)}}"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;Detalles Pedido</a>
                  
   
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->