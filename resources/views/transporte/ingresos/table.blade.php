<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        @include('transporte.ingresos.header_table')
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-ingreso-transporte" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              {{--La fecha de reporte y Alquiler de Buses de titulo en el excel--}}
              <th>Fecha Reporte</th>
              <th>Fecha de ingreso</th>
              <th>Placa</th>
              <th>Chofer</th>
              <th>Monto</th>  
            <!--   <th>Acciones</th> -->
              
            </tr>
          </thead>
          <tbody>
            @foreach ($ingresos as $ingreso)
              <tr>
                <td>{{$ingreso->fecha_reporte }}</td>
                <td>{{$ingreso->fecha_ingreso }}</td>
                <td>{{$ingreso->transporte->placa}}</td>
                <td>
                  @if($ingreso->transporte->chofer)
                    {{$ingreso->transporte->chofer}}
                  @else
                    <label class="label label-default" for="">Sin chofer asignado</label>
                  @endif
                  </td>
                <td>{{$ingreso->monto_ingreso}}</td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="4"  style="text-align:right">TOTAL</th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->