<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de GRIFOS Asignados</h2>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-pedido_clientes_res" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>RUC</th>
              <th>Nombre GRIFO</th>
              <th>Administrador</th>
              <th>STOCK</th>
              <th>Acciones</th>


            </tr>
          </thead>
          <tbody>
            @foreach ($pedidos_grifos as $pedidos_grifo)
              <tr>
                <td>{{$pedidos_grifo->id}}</td>
                <td> {{$pedidos_grifo->ruc}}</td>
                <td>{{$pedidos_grifo->razon_social}}</td>
                <td>{{$pedidos_grifo->administrador}}</td>
                <td>{{$pedidos_grifo->stock}}</td>
                <td> 
                    <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;Detalles Grifo</a>
                  
   
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->