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
              <th>#</th>
              <th>RUC</th>
              <th>Nombre GRIFO</th>
              <th>Administrador</th>
              <th>STOCK</th>
              <th>Cant x asig</th> 
              <th>Acción  </th>

            </tr>
          </thead>
          <tbody>
            @foreach ($grifos as $grifo)
              <tr>
                <td>{{$grifo->id}}</td>
                <td>{{$grifo->ruc}}</td>
                <td>{{$grifo->razon_social}}</td>
                <td>{{$grifo->administrador}}</td>
                <td>{{$grifo->stock}}</td>
              <form method="POST" action="{{route('asignar_gls')}}">
                <td>               
                    @csrf 
                    <input type="hidden" name="id_grifo" value="{{$grifo->id}}">
                    <input  type="hidden" name="id_pedido_pr" value="{{$pedido->id}}">
                    <input placeholder="gls" type="number" style="width: 70px;" name="galones_x_asignar" required="" >

                </td>
                <td>
                  @if( $pedido->getGalonesStock() <= 0 )
                    <button class="btn btn-success" disabled="">Asignar gls</button>
                  @else
                    <button class="btn btn-success">Asignar gls</button>
                  @endif
                </td>
              </form>  
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->