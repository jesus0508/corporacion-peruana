<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">   
        <div class="col-md-6"></div>
        <div class="col-md-6">
          <div class="pull-right">
            <button class="btn btn-success" data-toggle="modal" 
              data-target="#modal-pagar-gastos">
              <span class="fa fa-money"></span>
              Pagar Gastos 
            </button>
          </div>
        </div>     
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
              <th>Estado</th>
              <th>Monto</th>
              <th>Saldo</th>
              <th>Mes </th>            
            </tr>
          </thead>
          <tbody>
            @php setlocale(LC_TIME, "Spanish_Peru");
                \Carbon\Carbon::setLocale('es');
            @endphp   
            @foreach ($egresos as $egreso)
              <tr>
                <td>{{$egreso->fecha }}</td>
                <td>{{$egreso->getNombre() }}</td>
                <td>{{$egreso->concepto}}</td>
                <td>{{$egreso->getTipoComprobante()}}</td>
                <td>
                  @if($egreso->estado == 1)
                    <span class="label bg-maroon">POR PAGAR</span>
                  @else
                    <span class="label label-success">PAGADO</span>
                  @endif
                </td>
                <td>{{$egreso->monto}}</td>
                <td>{{$egreso->saldo}}</td>
                <td>{{$egreso->getMonthYear($egreso->fecha)}}</td>
                {{-- <td>{{ ucfirst(strftime("%B %Y",strtotime($egreso->fecha)))}}</td> --}}
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="5"  style="text-align:right">TOTAL</th>
              <th></th>
              <th></th>
              {{-- <th></th> --}}
            </tr>
          </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->