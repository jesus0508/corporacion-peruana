<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
    {{--   @include('transporte.egresos.header_table')  --}} 
    asdasda     
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-stock-grifos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              {{--La fecha de reporte y Alquiler de Buses de titulo en el excel--}}
              <th>FECHA</th>
              <th>Grifo </th>
              <th>Lectura Inicial </th>
              <th>Lectura Final</th>
              <th>Calibracion </th>
              <th>Venta en soles</th>
              <th>Precio</th>
              <th>Venta dia anterior</th> 
              <th>Stock según grifo</th> 
              <th>Stock según sistema</th>
              <th>Diferencia</th>
              <th>Traspaso</th>
              <th>Recepcion</th>
              <th>PRIMAX</th>
              <th>PECSA</th>
              <th>PBF</th>
              <th>Nuevo Stock</th>             
            </tr>
          </thead>
          <tbody>
            @foreach ($stock_grifos as $stock_grifo)
              <tr>
                <td>{{$stock_grifo->fecha_stock}}</td>
                <td>nombre grifo</td>
                <td>{{$stock_grifo->lectura_inicial}}</td>
                <td>{{$stock_grifo->lectura_final}}</td>
                <td>{{$stock_grifo->calibracion}}</td>
                <td>{{$stock_grifo->venta_soles}}</td>
                <td>{{$stock_grifo->precio_galon}}</td>
                <td>{{$stock_grifo->getGalones()}}</td>
                <td>{{$stock_grifo->stock_grifo}}</td>
                <td>100</td>
                <td>{{$stock_grifo->stock_grifo-100}}</td>
                <td>{{$stock_grifo->traspaso}}</td>
                <td>{{$stock_grifo->recepcion}}</td>
                <td>{{$stock_grifo->cantidad_primax}}</td>
                <td>{{$stock_grifo->cantidad_pecsa}}</td>
                <td>{{$stock_grifo->cantidad_pbf}}</td>
                <td>nuevo stock</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->