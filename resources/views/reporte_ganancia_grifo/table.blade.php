<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
        <table id="tabla-ganancia-grifo" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha</th>
              <th>Grifo</th>
              <th>Descripción</th>
              <th>Monto (S/.)</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $ingresos_egresos as $neto )
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{date('d/m/Y', strtotime($neto->day))}}</td>
                <td>{{$neto->grifo}}</td>  
                <td>
                  @if( is_numeric($neto->detalle) )
                    INGRESO: SubTotal X Día     
                  @else
                    EGRESO: {{$neto->detalle}}
                  @endif
                 
                </td>                
                <td>{{$neto->monto}}</td>

              </tr>            
            @endforeach       

          </tbody>
            <tfoot>
            <tr>
                <th colspan="4" style="text-align:right">TOTAL NETO:</th>
                <th></th>
            </tr>
        </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->