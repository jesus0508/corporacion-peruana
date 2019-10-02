<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Programación:</h2>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-reporte-programacion" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>date</th>
              <th>FECHA Descarga</th>
              <th>Grifo</th>              
              <th>Galones</th>
              <th>Horario descarga</th>
              <th>SCOP</th>
              <th>Nro Pedido</th>
              <th>Transportista</th>
              <th>Planta</th>              
            </tr>
          </thead>
          <tbody>
            @foreach( $pedidos as $pedido )
              <tr>
                <td>{{date( 'd/m/Y', strtotime($pedido->fecha_descarga) ) }}</td>
                <td>{{date( 'd/m/Y', strtotime($pedido->fecha_descarga) ) }}</td>
                <td>{{$pedido->razon_social}}</td>
                <td>{{$pedido->galones}}</td>
                <td>
                    @if($pedido->horario_descarga)
                    {{$pedido->horario_descarga}}                     
                    @else
                    PROPIO
                    @endif
                </td>
                <td>{{$pedido->scop}}</td>
                <td>{{$pedido->nro_pedido}}</td>
                <td>
                  @if($pedido->nombre_transportista)
                    {{$pedido->nombre_transportista}}
                  @else
                  PROPIO
                  @endif
                </td>
                <td>{{$pedido->planta}}</td>
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