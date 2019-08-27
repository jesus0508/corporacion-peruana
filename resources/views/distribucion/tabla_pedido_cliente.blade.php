<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de Pedidos por Distribuir</h2>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-pedido_clientes_dist" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>Fecha de Pedido</th>
              <th>Cliente</th>
              <th>Cantidad GLS</th>
              <th>Galones asignados</th>
              <th>Estado</th>
              <th>Acción</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($pedidos_cl as $pedido_cliente)
              <tr>
                <td>{{date('d/m/Y', strtotime($pedido_cliente->created_at))}}</td>
                <td>{{$pedido_cliente->cliente->razon_social}}</td>
                <td>{{$pedido_cliente->galones}}</td>
                <td>{{$pedido_cliente->galones_asignados}}</td> 
                <td>  
            
                       <?php 
                       if( $pedido_cliente->galones_asignados != 0 ){
                       echo '<div class = "progress-bar progress-bar-success progress-bar-striped active" role = "progressbar" aria-valuenow = "60" aria-valuemin = "0" aria-valuemax = "100" style = "width:' . number_format($pedido_cliente->galones_asignados*100/$pedido_cliente->galones, 2) . '%;">' . $pedido_cliente->galones_asignados.'/'.$pedido_cliente->galones.' gls';}
                        else {
                          echo "<label class='label label-danger'> 0 galones asignados </label>";
                        }
                       ?>
   
                </td>
                <td>
                  <form method="POST" action="{{route('asignar_individual')}}">
                    @csrf 
                    <input type="hidden" name="id_pedido_cliente" value="{{$pedido_cliente->id}}">
                    <input  type="hidden" name="id_pedido_pr" value="{{$pedido->id}}">
                    @if( $pedido->getGalonesStock() <= 0 )
                      <button class="btn btn-success" disabled="">Asignar gls</button>
                    @else
                      <button class="btn btn-success"><span class="fa fa-cart-arrow-down"></span>&nbsp;Asignar gls</button>
                    @endif
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