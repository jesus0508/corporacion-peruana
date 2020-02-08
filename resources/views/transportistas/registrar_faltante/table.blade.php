<section class="content">
<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
            <h2 class="box-title">Lista de Fletes | <b>REGISTRAR FALTANTES</b></h2>     
      </div><!-- /.box-header -->

      <div class="box-body">
        <table id="tabla-flete-pedidos-sin-pagar" class="table table-bordered table-striped responsive display" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>Fecha Descarga</th>
              <th>GRIFO</th>
              <th>Gls</th>
              <th>SCOP</th>
              <th>Transportista</th>
              <th>Planta</th>
              <th>Accion</th> 
            </tr>
          </thead>
          <tbody>
            @foreach ($pedidos as $pedido_cliente)
              <tr>
                <td>  
                  @if( $pedido_cliente->fecha_descarga )
                  {{date('d/m/Y', strtotime($pedido_cliente->fecha_descarga))}}
                  @else
                  No acordado
                  @endif
                </td>
                <td>{{$pedido_cliente->razon_social}}</td>
                <td>{{$pedido_cliente->galones}}</td>
                <td>        
                  <a href="{{route('pedidos.ver_distribucion', $pedido_cliente->id)}}"> {{$pedido_cliente->scop}}
                  </a>                  
                </td>
                <td>{{$pedido_cliente->nombre_transportista}}</td>
                <td>{{$pedido_cliente->planta}}</td>
                <td><a href="#modal-registrar-faltante" data-toggle="modal" data-target="#modal-registrar-faltante" class="btn btn-success" data-pivote="{{$pedido_cliente->id_pivote}}"  
                  data-pedido_cliente_id="{{ $pedido_cliente->pedido_cliente_id }}"
                 data-id_pedido="{{ $pedido_cliente->id }}"><span class="fa fa-battery-3"></span> &nbsp;Registrar Faltante</a>
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
</section>