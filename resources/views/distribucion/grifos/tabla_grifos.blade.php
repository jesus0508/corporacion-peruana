<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title"><b> Lista de GRIFOS</b></h2>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-pedido_clientes_dist" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>RUC</th>
              <th>Nombre GRIFO</th>
              <th>STOCK</th>
           <!--   <th>Periodicidad </th>-->
              <th>cant/Acción</th> 
              <th>Estado</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($pedidos_cl as $pedido_cliente)
              <tr>
                <td>{{$pedido_cliente->ruc}}</td>
                <td>{{$pedido_cliente->razon_social}}</td>
                <td>Stock grifo?</td>
              <!--  <td>{{$pedido_cliente->linea_credito}}</td>
                <td>{{$pedido_cliente->periocidad}}</td> -->
                <td>
                <form method="POST" action="{{route('asignar_gls')}}">

                    @csrf 
                    <input type="hidden" name="id_pedido_cliente" value="{{$pedido_cliente->id}}">
                    <input type="hidden" name="galones_pedido_cl" value="{{$pedido_cliente->galones-$pedido_cliente->galones_asignados}}">
                    <input  type="hidden" name="id_pedido_pr" value="{{$pedido->id}}">
                    <input placeholder="gls" type="number" style="width: 50px;" name="galones_stock" required="" >
                   <button class="btn btn-primary" disabled>Asignar gls</button>
                </form>

                </td>
                <td>  
            
                       <?php 
                       if( $pedido_cliente->galones_asignados != 0 ){
                       echo '<div class = "progress-bar progress-bar-success progress-bar-striped active" role = "progressbar" aria-valuenow = "60" aria-valuemin = "0" aria-valuemax = "100" style = "width:' . number_format($pedido_cliente->galones_asignados*100/$pedido_cliente->galones, 2) . '%;">' . $pedido_cliente->galones_asignados.'/'.$pedido_cliente->galones.' gls';}
                        else {
                          echo "<label class='label label-danger'> 0 galones asignados </label>";
                        }
                       ?>
   
                  </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->