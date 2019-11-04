<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header">
        <div class="row">
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-addon">Grifo</span>
              <select class="form-control" id="filter-grifo" name="planta_id">
                @foreach( $grifos as $grifo )
                  <option value="{{$grifo->id}}">{{$grifo->razon_social}}</option>
                @endforeach
              </select>
            </div><!-- /input-group -->
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-2">            
            <div class="form-group">
              <label for="fecha_inicio">Mes: </label>
              <input autocomplete="off" id="fecha_inicio_month" type="text" class="tuiker form-control"
                      name="fecha_inicio" placeholder="Mes facturación">
            </div>            
          </div>
          <div class="col-md-5">
            <div class="row filtrado">
              <div class="col-md-6">
                <div class="form-inline">
                    <label for="fecha_inicio">FECHA: </label>
                    <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control"
                      name="fecha_inicio" placeholder="Ingrese fecha facturación">
                </div>
              </div>
              <div class="col-md-6 pull-right" >
                <button id="filtrar-fecha" class="btn btn-info">
                    <i class="fa fa-search"></i>
                    Filtrar
                </button>
                <button id="clear-fecha" class="btn btn-danger">
                    <i class="fa fa-remove "></i>
                    Limpiar
                </button>
              </div>
            </div>
          </div>
        </div> <!-- end.row header -->       
      </div>
      <div class="box-body">
        <table id="tabla-cancelaciones-total" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>Fecha Facturación</th>
              <th>Grifo</th>
              <th>Venta Factura</th>
              <th>Venta Boleta</th>              
              <th>Galones</th>
              <th>Precio</th>
              <th>Monto Total</th>
              <th>Saldo</th>              
              <th>N° de operación</th>
              <th>Fecha de depósito </th>
              <th>Monto Depósito</th>
              <th>Mes Año</th>
            </tr>
          </thead>
          <tbody>
            @php setlocale(LC_TIME, "spanish"); @endphp 
            @foreach( $cancelaciones as $cancelacion )
              <tr>                
                <td>{{date('d/m/Y', strtotime($cancelacion->facturacionGrifo->fecha_facturacion))}}</td>
                <td>{{$cancelacion->facturacionGrifo->grifo->razon_social}}</td>
                <td>{{$cancelacion->facturacionGrifo->venta_factura}}</td>
                <td>{{$cancelacion->facturacionGrifo->venta_boleta}}</td>
                <td>{{$cancelacion->facturacionGrifo->getGalones() }}</td>
                <td>{{$cancelacion->facturacionGrifo->precio_venta}}</td>
                <td>{{round($cancelacion->facturacionGrifo->getMontoTotal(),2)}}</td>    
                <td>{{round($cancelacion->facturacionGrifo->getSaldo(),2)}}</td>         
                <td>{{$cancelacion->nro_operacion}}</td>
                <td>{{date('d/m/Y', strtotime($cancelacion->fecha))}}</td>
                <td>{{$cancelacion->monto}}</td>   
                <td>{{ ucfirst(strftime("%B %Y",strtotime($cancelacion->facturacionGrifo->fecha_facturacion) ) )}}</td>          
              </tr>            
            @endforeach        

          </tbody>
            <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th> <!-- total factura -->
                <th></th>
                <th></th> <!-- total galones -->
                <th></th>
                <th></th><!--  total -->
                <th></th> <!-- saldo -->
                <th colspan="2">TOTAL DEPÓSITOS</th> 
                <th></th> <!-- depositos -->
                <th></th>
            </tr>
        </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->