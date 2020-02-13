<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">  
        <h4>Gastos a pagar</h4>   
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-egreso-gerencia" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              {{--La fecha de reporte y Alquiler de Buses de titulo en el excel--}}
              <th>Fecha</th>
              <th>Nombre y/o Razon Social</th>
              <th>Concepto</th>  
              <th>Tipo Comprobante</th>
              {{-- <th>Estado</th> --}}
              <th>Monto gasto</th>
              <th>Saldo(actual)</th>
              <th>Monto ha pagar</th>
             {{--  <th>Mes reporte</th> --}}            
            </tr>
          </thead>
          <tbody>
            @php setlocale(LC_TIME, "spanish"); @endphp   
            @foreach ($egresos_pago as $egreso)
              <tr>
                <input type="hidden" name="gastos[]" value="{{$egreso->id}}">
                <td>{{$egreso->fecha }}</td>
                <td>{{$egreso->nombre }}</td>
                <td>{{$egreso->concepto}}</td>
                <td>{{$egreso->tipo}}</td>
                <td>{{$egreso->monto}}</td>
                <td>{{$egreso->saldo}}</td>
                <td>{{$egreso->asignacion}}</td>
                {{-- <td>{{ ucfirst(strftime("%B %Y",strtotime($egreso->date_reporte)))}}</td> --}}
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="6"  style="text-align:right">MONTO PAGO TOTAL</th>
              <th></th>
              {{-- <th></th> --}}
            </tr>
          </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->