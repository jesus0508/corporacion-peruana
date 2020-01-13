<section class="content">
<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
                
      </div><!-- /.box-header -->

      <div class="box-body">
        <table id="tabla-flete-faltantes" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>SCOP</th>
              <th>Descripcion</th>
              <th>Fecha Descarga</th>
              <th>GRIFO</th>
              <th>Transportista</th>
      <!--         <th>Planta</th> -->
              <th>Grifero</th>
              <th>Faltante gls</th>
              <th>Precio</th>
              <th>Monto Desc</th>
              <th>Accion</th>
 
            </tr>
          </thead>
          <tbody>
            @foreach ($pedidos as $pedido_cliente)
              <tr>
                <td>{{$pedido_cliente->scop}}</td>
                <td>{{$pedido_cliente->descripcion}}</td>
                <td>  
                  @if( $pedido_cliente->fecha_descarga )
                  {{date('d/m/Y', strtotime($pedido_cliente->fecha_descarga))}}
                  @else
                  No acordado
                  @endif
                </td>
                <td>{{$pedido_cliente->razon_social}}</td>
                <td>{{$pedido_cliente->nombre_transportista}}</td>                
              <!--   <td>{{$pedido_cliente->planta}}</td> -->
                <td>{{$pedido_cliente->grifero}}</td>
                <td>{{$pedido_cliente->faltante}}</td>
                <td>{{$pedido_cliente->costo_galon}}</td>
                <td>
                  <label for="" class="label label-info">
                    S/&nbsp;    {{number_format((float)
                        $pedido_cliente->faltante * $pedido_cliente->costo_galon, 2, '.', '') }}                 
                  </label>                           
                </td>
                <td>
                  @if($pedido_cliente->estado_flete==1)
                    @if($pedido_cliente->id_a_eliminar_cliente)                    
                      <form style="display:inline" method="POST"  onsubmit="return confirmar()" action="{{ route('faltante.destroy', $pedido_cliente->id_a_eliminar_cliente) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar</button>
                      </form>
                    @else
                      <form style="display:inline" method="POST" 
                       onsubmit="return confirmar()" 
                       action="{{ route('flete.destroyGrifoFaltante',
                       ['id' => $pedido_cliente->id_a_eliminar_grifo, 
                       'id_grifo'=>$pedido_cliente->id_grifo]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar</button>
                      </form>                  
                    @endif
                  @endif
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