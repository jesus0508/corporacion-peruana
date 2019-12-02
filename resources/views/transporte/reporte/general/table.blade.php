<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
        <table id="tabla-ingresos-netos-general-diario" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha Reporte</th>
              <th>Fecha</th>
              <th>Placa</th>
              <th>Tipo</th>
              <th>Monto(S/.)</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $netos as $neto )
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$neto->fecha_reporte }}</td>
                <td>{{date('d/m/Y', strtotime($neto->day))}}</td>
                <td>{{$neto->placa}}</td>   
                <td>
                  @switch($neto->tipo)
                      @case(1)
                          Auto
                          @break
                      @case(2)
                          Bus
                          @break
                      @case(3)
                          Cisterna
                          @break
                      @case(4)
                          Administrativo
                          @break
                      @default
                          Default case...
                  @endswitch
                </td>               
                <td>{{$neto->monto}}</td>

              </tr>            
            @endforeach       

          </tbody>
            <tfoot>
            <tr>
                <th colspan="5" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->