<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
        <table id="tabla-ingresos-netos-mensual" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha</th>
              <th>Placa</th>
              <th>Subtotal Ingresos</th>
              <th>Subtotal Egresos</th>
              <th>Monto Neto(S/.)</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @php setlocale(LC_TIME, "spanish"); @endphp
            @foreach( $netos as $neto )
              <tr>
                <td>{{$loop->iteration}}</td>    
                <td>{{$neto->fecha_reporte}}</td>
                <td>{{$neto->placa}}</td>                  
                <td>{{$neto->monto_ingreso}}</td>
                <td>{{$neto->monto_egreso}}</td>
                <td>{{$neto->monto_neto}}</td>
                <td>{{ ucfirst(strftime("%B %Y",strtotime($neto->day) ) )}}</td>
              </tr>            
            @endforeach       

          </tbody>
            <tfoot>
            <tr>
                <th colspan="5" style="text-align:right">Total:</th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->