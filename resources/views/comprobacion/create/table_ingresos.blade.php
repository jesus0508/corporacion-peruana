<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de ingresos en EFECTIVO</h2>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-reporte-ingresos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>FECHA reporte</th>
              <th>CATEGORIA</th>              
              <th>Detalles</th>
              <th>FECHA ingreso</th>
              <th>Extra Info</th>
              <th>Banco</th>
              <th>Monto</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $ingresos as $ingreso )
              <tr>
                <td>@if($ingreso->fecha_reporte)
                    {{date('d/m/Y', strtotime($ingreso->fecha_reporte))}}                     
                    @else
                    {{date('d/m/Y', strtotime($ingreso->fecha_ingreso))}}
                    @endif</td>
                <td>{{$ingreso->categoria}}</td>
                <td>
                  @if($ingreso->detalle)
                  {{$ingreso->detalle}}
                  @else
                  {{$ingreso->categoria}}
                  @endif                
                </td>
                <td>
                   {{$ingreso->fecha_ingreso}}
                </td>
                <td>
                  @if($ingreso->codigo_operacion)
                  {{$ingreso->codigo_operacion}}
                  @else
                  {{$ingreso->zona}}
                  @endif                  
                </td>
                <td>{{$ingreso->banco}}</td>
                <td>{{$ingreso->monto_ingreso}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="box-footer">
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->