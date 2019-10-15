<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title pull-left">Lista de PAGOS A 
            <a href="{{route('transportista.index')}}">Transportistas</a> &nbsp; &nbsp; &nbsp;
          </h3>   
        </div>
        <!-- /.box-header -s-->
        <div class="box-body">
          <table id="tabla-pagos_lista" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Transportista  Pagado</th>
                <th>Fecha de Pago</th>              
                <th>Monto de Pago</th>
                <th>Dsct Pendiente</th>    
                <th>Acciones</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($pagos as $pago)

                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$pago->nombre_transportista}}</td>
                  <td>{{date('d/m/Y', strtotime($pago->fecha_pago))}}</td>              
                  <td>{{$pago->monto_total_pago}}</td>
                  <td>{{$pago->pendiente_dejado}}</td>                 
                  <td>
                    <a href="{{ route('pago_transportistas.show', $pago->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i>&nbsp;&nbsp;Ver</a>
             <!--        <a href="{{ route('pago_proveedors.resumen_pago', $pago->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i>&nbsp;&nbsp;Ver Operación</a>
 -->
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
