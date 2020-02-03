
<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
        <table id="tabla-ingresos-netos-anual" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>Fecha Reporte</th>
              <th>Tipo</th>
              <th>Placa</th>
              <th>Monto Ingreso|Egreso</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
             @php setlocale(LC_TIME, "spanish"); @endphp
            @foreach( $ingresos as $ingreso )
              <tr>   
                <td>{{ ucfirst(strftime("%B %Y",strtotime($ingreso->day) ) )}}</td>
                <td>{{$ingreso->getTipo()}}</td>                 
                <td>{{$ingreso->placa}}</td>                  
                <td>{{$ingreso->monto}}</td>
                <td>{{ ucfirst(strftime("%Y",strtotime($ingreso->day) ) )}}</td>
              </tr>            
            @endforeach       
            @foreach( $egresos as $egreso )
              <tr> 
                <td>{{ ucfirst(strftime("%B %Y",strtotime($egreso->day) ) )}}</td>
                <td>{{$egreso->getTipo()}}</td>                
                <td>{{$egreso->placa}}</td>                  
                <td>{{$egreso->monto}}</td>
                <td>{{ ucfirst(strftime("%Y",strtotime($egreso->day) ) )}}</td>
              </tr>            
            @endforeach    

          </tbody>
            <tfoot>
            <tr>
                <th colspan="3" style="text-align:right">Total:</th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->