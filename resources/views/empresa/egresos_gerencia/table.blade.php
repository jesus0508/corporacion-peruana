<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">        
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
             {{--  <th>Mes reporte</th> --}}            
            </tr>
          </thead>
          <tbody>
            @php setlocale(LC_TIME, "spanish"); @endphp   
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
                {{-- <td>{{ ucfirst(strftime("%B %Y",strtotime($egreso->date_reporte)))}}</td> --}}
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="5"  style="text-align:right">TOTAL</th>
              <th></th>
              {{-- <th></th> --}}
            </tr>
          </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->