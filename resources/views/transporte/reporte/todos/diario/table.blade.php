<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
        <table id="tabla-netos-unidades-diario" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>Fecha Reporte</th>
              <th>Fecha Ingreso|Egreso</th>
              <th>Placa</th>
              <th>Tipo</th>
              <th>Monto (S/.)</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $ingresos as $ingreso )
              <tr>
                <td>{{$ingreso->fecha_reporte}}</td>
                <td>{{$ingreso->fecha_ingreso}}</td>
                <td>{{$ingreso->transporte->placa}}</td>
                <td>{{$ingreso->transporte->getTipo()}}</td>                  
                <td>{{$ingreso->monto_ingreso}}</td>
              </tr>            
            @endforeach       
            @foreach( $egresos as $egreso )
              @if($egreso->transporte!=null) {{-- Si es null, es otro transporte --}}
              <tr>
                <td>{{$egreso->fecha_reporte}}</td>
                <td>{{$egreso->fecha_egreso}}</td>
                <td>{{$egreso->transporte->placa}}</td>
                <td>{{$egreso->transporte->getTipo()}}</td>                  
                <td>{{-1*$egreso->monto_egreso}}</td>
              </tr> 
              @endif
            @endforeach                 
            </tbody>
            <tfoot>
            <tr>
                <th colspan="4" style="text-align:right">Total Neto:</th>
                <th></th>
            </tr>
        </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->