<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header">

          <h3 class="box-title pull-left">Lista de PAGOS A 
            <a href="{{route('pedidos.show',$pedido->id)}}">Pedido</a> &nbsp; &nbsp; &nbsp;
          </h3>
   
        </div>
        <!-- /.box-header -s-->
        <div class="box-body">
          <table id="proveedores" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Fecha de Operacion</th>
                <th>Número de Operacion</th>
                <th>Monto de Operacion</th>
                <th>Banco</th> 
                <th>Fecha registro al sistema</th>
                <th>Acciones</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($pedido->pagosProveedor as $pago)

                <tr>
                  <td>{{$pago->id}}</td>
                  <td>{{$pago->fecha_operacion}}</td>                  
                  <td>{{$pago->codigo_operacion}}</td>
                  <td>{{$pago->monto_operacion}}</td>
                  <td>{{$pago->banco}}</td>
                  <td>{{$pago->created_at}}</td> 
                  <td><a href="{{ route('pago_proveedors.resumen_pago', $pago->id)}}" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp;Ver Operación</a></td>      
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
</section>
