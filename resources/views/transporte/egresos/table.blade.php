<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
       @include('transporte.egresos.header_table')        
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-egreso-transporte" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              {{--La fecha de reporte y Alquiler de Buses de titulo en el excel--}}
              <th>Fecha Reporte</th>
              <th>Fecha de egreso</th>
              <th>Tipo</th>  
              <th>Placa</th>
              <th>Tipo Comprobante</th>
              <th>N° comprobante</th>
              <th>Descripción</th>
              <th>Monto</th>
              <th>Mes reporte</th>            
            </tr>
          </thead>
          <tbody>
            @php setlocale(LC_TIME, "spanish"); @endphp   
            @foreach ($egresos as $egreso)
              <tr>
                <td>{{$egreso->fecha_reporte }}</td>
                <td>{{$egreso->fecha_egreso }}</td>
                <td>{{$egreso->transporte->getTipo()}}</td>
                <td>{{$egreso->transporte->placa}}</td>
                <td>{{$egreso->getTipoComprobante()}}</td>
                <td>{{$egreso->nro_comprobante}}</td>
                <td>{{$egreso->descripcion}}</td>
                <td>{{$egreso->monto_egreso}}</td>
                <td>{{ ucfirst(strftime("%B %Y",strtotime($egreso->date_reporte)))}}</td>

              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="7"  style="text-align:right">TOTAL</th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->