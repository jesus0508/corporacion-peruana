<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de egresos</h2>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-reporte-egresos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>FECHA egreso</th>
              <th>CATEGORIA</th>              
              <th>Detalles</th>
              <th>FECHA reporte</th>
              <th>N° Cheque</th>
              <th>Extra Info</th>
              <th>Banco</th>
              <th>Monto</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $egresos as $egreso )
              <tr>
                <td>{{$egreso->fecha_egreso}}</td>
                <td>{{$egreso->categoria}}</td>
                <td>
                  @if($egreso->detalle)
                  {{$egreso->detalle}}
                  @else
                  {{$egreso->categoria}}
                  @endif                
                </td>
                <td>
                    @if($egreso->fecha_reporte)
                    {{date('d/m/Y', strtotime($egreso->fecha_reporte))}}                     
                    @else
                    {{date('d/m/Y', strtotime($egreso->fecha_egreso))}}
                    @endif
                </td>
                <td>{{$egreso->nro_cheque}}</td>
                <td>
                  {{$egreso->codigo_operacion}}                 
                </td>
                <td>{{$egreso->banco}}</td>
                <td>{{$egreso->monto_egreso}}</td>
                <td>
                  @if(!$egreso->esPagoProveedor)
                    <btn class="btn btn-xs btn-warning btn-block" 
                      href="#modal-edit-salidas"  
                      data-toggle="modal" data-target=" #modal-edit-salidas"
                      data-id="{{$egreso->id}}">
                      <span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Editar                       
                    </btn> 
                  @endif
                </td>
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