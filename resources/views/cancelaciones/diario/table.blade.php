<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
        <table id="tabla-gastos-grifo-diarios" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha Ingreso</th>
              <th>Grifo</th>
              <th>Galones</th>
              <th>Precio</th>              
              <th>N° de operación</th>
              <th>Fecha de depósito </th>
              <th>Monto Depósito</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $cancelaciones as $cancelacion )
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{date('d/m/Y', strtotime($cancelacion->ingresoGrifo->fecha_ingreso))}}</td>
                <td>{{$cancelacion->razon_social}}</td>                  
                <td>{{$cancelacion->lectura_final-$cancelacion->lectura_inicial}}</td>
                <td>{{$cancelacion->precio_galon}}</td>
                
                <td>{{$cancelacion->nro_operacion}}</td>
                <td>{{$cancelacion->fecha}}</td>
                <td>{{$cancelacion->monto}}</td>
              </tr>            
            @endforeach        

          </tbody>
            <tfoot>
            <tr>
                <th colspan="7" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->