<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header">

          <h3 class="box-title pull-left">Lista de COMPRAS A 
            <a href="{{route('proveedores.index')}}">PROVEEDORES</a> &nbsp; &nbsp; &nbsp;
          </h3>
            <div class="pull-right">
              <a href="{{ route('pedidos.create') }}">
              <button class="btn bg-olive">
               <span class="fa fa-plus"></span> &nbsp;Nuevo Pedido Proveedor
              </button>
              </a>
              <a href="{{route('factura_proveedor.create')}}">
                <button class="btn bg-purple">
                Registrar Factura &nbsp;   <i class="fa fa-share-square-o"></i>
                </button>
              </a>  
              <a href="#">
                <button class="btn btn-default">
                  <span class="fa fa-file-excel-o"></span> &nbsp;Exportar a Excel 
                </button>
              </a>
            </div>   
        </div>
        <!-- /.box-header -s-->
        <div class="box-body">
             @include('pedidosP.partials.opciones')
          <table id="proveedores" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nro pedido</th>
                <th>SCOP</th>
                <th>Planta</th>
                <!-- <th>Fecha pedido</th> -->
                <th>GLS</th>
                <th>Precio galon/u</th> 
                <th>Monto (S/.)</th>
                <!-- <th>M.Facturado (S/.) </th> -->
                <th>Saldo</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pedidos as $pedido)

                <tr>
                  <td>{{$pedido->nro_pedido}}</td>
                  <td>{{$pedido->scop}}</td>                  
                  <td>{{$pedido->planta}}</td>
                  <!-- <td>{{$pedido->created_at}}</td> -->
                  <td>{{$pedido->galones}}</td>
                  <td>{{$pedido->costo_galon}}</td>
                  <td>{{ $pedido->calc }} </td>
<!--                   <td>
                    @if( $pedido->factura_proveedor_id != null )                      
                     {{$pedido->monto_factura}} 
                    @else
                      0.00
                    @endif
                  </td> -->
                  <td>
                    {{$pedido->saldo}}                     
                  </td>  
                  <td>
                    @include( 'actions.pedido.estado_dirigir' )
                  </td>  
                  <td>
                    @include( 'actions.pedido.acciones_dirigir' )
                  </td>             
                         
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
</section>
