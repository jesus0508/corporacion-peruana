<section class="content">
<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <h2 class="box-title" align="center">Flete del Sr <label class="label label-primary">{{$pedidosToSelect[0]->nombre_transportista}}</label></h2>  
          </div>          
        </div>    
      </div><!-- /.box-header -->
      <div class="box-body">        
            <table id="tabla-pago-select" class="table table-bordered select table-striped responsive display nowrap" style="width:100%" cellspacing="0">
              <thead>
                <tr>
                  <th></th>
                  <th>FLETERO</th>
                  <th>Fecha PEDIDO</th>
                  <th>SCOP</th>
                  <th>N° de PEDIDO</th>
                  <th>PLANTA</th>
                  <th>Galones TOTAL</th>
                  <th>Costo Flete</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pedidosToSelect as $pedido)
                  <tr>
                    <td>{{$pedido->id}}-{{$pedido->costo_flete}}</td>
                    <td>{{$pedido->nombre_transportista}}</td>
                    <td>{{$pedido->fecha_pedido}}</td>
                    <td>              
                      <a href="{{route('pedidos.ver_distribucion', $pedido->id)}}"> {{$pedido->scop}}
                      </a>                   
                    </td>
                    <td>{{$pedido->nro_pedido}}</td>
                    <td>{{$pedido->planta->planta}}</td>
                    <td>{{$pedido->galones}}</td>      
                    <td><b> S/. &nbsp;{{$pedido->costo_flete}}</b></td>
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