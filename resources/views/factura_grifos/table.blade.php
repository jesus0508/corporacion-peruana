<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header">
        <div class="row">
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">Grifo</span>
                <select class="form-control" id="filter-grifo" name="planta_id">
                  @foreach( $grifos as $grifo )
                    <option value="{{$grifo->id}}">{{$grifo->razon_social}}</option>
                  @endforeach
                </select>
            </div><!-- /input-group -->
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <button class="btn btn-primary" id="yesterday-fecha">
              <span class="fa fa-list-alt"></span> &nbsp;{{$last_month}}
              </button>
              <input type="hidden" id="last_month_date" value="{{$last_month_date}}">
              <button class="btn btn-success" id="today-fecha">
              <span class="fa fa-list-alt"></span> &nbsp;{{$month_actual}}
              </button>
              <input type="hidden" id="month_actual_date" value="{{$month_actual_date}}">
              <button id="clear-fecha" class="btn btn-danger">
                    <i class="fa fa-remove "></i>
                    Limpiar
              </button>
            </div>
          </div>
          <div class="col-md-4">
            <div class="row filtrado">
              <div class="col-md-6">
                <div class="form-inline">
                  <label for="fecha_inicio">FECHA: </label>
                  <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control"
                      name="fecha_inicio" placeholder="Ingrese mes">
                </div>
              </div>
              <div class="col-md-5 pull-right" >
                  <button id="filtrar-fecha" class="btn btn-info">
                    <i class="fa fa-search"></i>
                    Filtrar
                  </button>
              </div>
            </div>
          </div>          
        </div> <!-- end.row -->
      </div>
      <div class="box-body">
        <table id="tabla-factura-grifos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Grifo</th>
              <th>Venta factura</th>
              <th>Venta boleta</th>
              <th>Total Galones</th>
              <th>Precio</th>
              <th>Monto Total</th>
              <th></th>
              <th>Saldo</th>              
            </tr>
          </thead>
          <tbody>   
            @php setlocale(LC_TIME, "spanish"); @endphp         
            @foreach( $factura_grifos as $factura_grifo ) 
              <tr>                
                <td>{{date('d/m/Y', strtotime($factura_grifo->fecha_facturacion))}}</td>
                <td>{{$factura_grifo->grifo->razon_social}}</td>
                <td>{{$factura_grifo->venta_factura}}</td>
                <td>{{$factura_grifo->venta_boleta}}</td>
                <td>{{$factura_grifo->getGalones() }}</td>
                <td>{{$factura_grifo->precio_venta}}</td>
                <td>{{round($factura_grifo->getMontoTotal(),2)}}</td>
                <td>{{ ucfirst(strftime("%B %Y",strtotime($factura_grifo->fecha_facturacion) ) )}}</td>
                <td>{{round($factura_grifo->getSaldo(),2)}}</td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
                <th colspan="2">Total Factura</th>
                <th></th> <!-- total factura -->
                <th>Total Galones</th>
                <th></th> <!-- total galones -->
                <th colspan="1" style="text-align:right">Total:</th>
                <th></th><!--  total -->
                <th></th> <!-- no visible -->
                <th></th> <!-- saldo -->
            </tr>
          </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->