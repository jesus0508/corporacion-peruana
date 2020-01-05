<section class="content">
<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <h2 class="box-title" align="center">Pago de Flete Sr <label class="label label-primary">{{$transportista->nombre_transportista}}</label> &nbsp; <span>{{date('d/m/Y', strtotime($pago_transportista->fecha_pago))}}</span></h2>  
          </div>          
        </div>    
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-pago-transportista" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>FLETERO</th>
              <th>GRIFO</th>
              <th>F PEDIDO</th>
              <th>SCOP</th>
              <th>N de PEDIDO</th>
              <th>PLANTA</th>
              <th>GLS</th>
              <th>PRECIO</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pedidos as $pedido_cliente)
              <tr>
                <td>{{$pedido_cliente->nombre_transportista}}</td>
                <td>{{$pedido_cliente->razon_social}}</td>
                <td>
                  @if( $pedido_cliente->fecha_descarga )
                  {{date('d/m/Y', strtotime($pedido_cliente->fecha_descarga))}}
                  @else
                  No acordado
                  @endif
                </td>
                <td>              
                  <a href="{{route('pedidos.ver_distribucion', $pedido_cliente->id)}}"> {{$pedido_cliente->scop}}
                  </a>                   
                </td>
                <td>{{$pedido_cliente->nro_pedido}}</td>
                <td>{{$pedido_cliente->planta}}</td>
                <td>{{$pedido_cliente->galones}}</td>      
                <td><b> S/. &nbsp;{{$pedido_cliente->costo_flete}}</b></td>
              </tr>
            @endforeach
          </tbody> 
          <tfoot>
            <tr>                
                <th colspan="7">SUBTOTAL</th>
                <th>S/. &nbsp; {{$subtotal}}</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="box-footer">

      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->
</section>