<section class="content">
  <h2>LISTA DE PEDIDOS</h2>
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Lista de COMPRAS A PROVEEDORES - Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="proveedores" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nro pedido</th>
                <th>Planta</th>
                <th>SCOP</th>
           <!--     <th>Fecha pedido</th>-->
                <th>Cantidad GLS</th>
            <!--    <th>Precio galon/u</th> -->
                <th>Monto</th>
                <th>Estado</th>
                 <th>Acciones</th>



              </tr>
            </thead>
            <tbody>
              @foreach ($pedidos as $pedido)
                <tr>
                  <td>{{$pedido->nro_pedido}}</td>
                  <td>{{$pedido->planta}}</td>
                  <td>{{$pedido->scop}}</td>
            <!--      <td>{{date('d/m/Y', strtotime($pedido->fecha_despacho))}}</td> -->
                  <td>{{$pedido->galones}}</td>
             <!--     <td>S/&nbsp;{{$pedido->costo_galon}}</td> -->
                  <td>S/&nbsp;{{number_format((float)
                    $pedido->galones*$pedido->costo_galon, 2, '.', '') }}</td>
                  <td> <span class="label label-danger">SIN CONFIRMAR</span> </td>
                  <td>
                    <a href="{{route('factura_proveedor.create')}}" class="btn btn-success"><i class="fa fa-check-square-o"> &nbsp; </i>CONFIRMAR</a>
                    <button class="btn btn-info" > <span class="glyphicon glyphicon-eye-open"></span>
                    </button>
                    <button class="btn btn-warning" > <span class="glyphicon glyphicon-edit"></span>
                    </button>

                    <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>

                  </td>                 
              
                    

                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
  @include('pedidosP.process')
  @include('pedidosP.show')
  @include('pedidosP.edit')
</section>