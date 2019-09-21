<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
        <table id="tabla-gastos-anual" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Año</th>
              <th>Mes</th>
              <th>Monto</th>
            </tr>
          </thead>
          <tbody>
            @php setlocale(LC_TIME, "spanish");   @endphp 
            @foreach( $egresos as $egreso )
              <tr>
                <td>{{ $loop->iteration}}</td>  
                <td>{{ $egreso->year}}</td> 
                <td>{{ ucfirst(strftime("%B %Y",strtotime($egreso->day) ) )}}</td>             
                <td>{{$egreso->subtotal}}</td>
              </tr>            
            @endforeach    
          </tbody>
            <tfoot>
            <tr>
                <th colspan="3" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->