<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <div class="row filtrado">
              <div class="col-md-4">
                <div class="form-inline">
                  <label for="fecha_inicio">Desde: </label>
                  <input autocomplete="off" id="fecha_inicio" type="text" class="tuiker form-control" value="" 
                    name="fecha_inicio" placeholder="Desde">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-inline">
                  <label for="fecha_fin">Hasta: </label>
                  <input autocomplete="off" id="fecha_fin" type="text" class="tuiker form-control"  value="" 
                    name="fecha_fin" placeholder="Final">
                </div>
              </div>
              <div class="col-md-4">
                <button id="filtrar-fecha" class="btn btn-info">
                  <i class="fa fa-search"></i>
                  Buscar
                </button>
                <button id="clear-fecha" class="btn btn-danger">
                  <i class="fa fa-remove "></i>
                  Limpiar
                </button>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-grifos-balance" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Grifo Sale</th>
              <th>Stock(restado)</th>
              <th>traspaso</th>
              <th>Grifo Entra</th>
              <th>stock(sumado)</th>  
            </tr>
          </thead>
          <tbody>
            @foreach ($balanceos as $balanceo)
              <tr>
                <td>{{$balanceo->fecha}}</td>
                <td>{{$balanceo->grifo_sender}}</td>
                <td>{{$balanceo->grifo_sender_stock_nuevo}}</td>
                <td>{{$balanceo->cantidad}}</td>
                <td>{{$balanceo->grifo_receiver}}</td>
                <td>{{$balanceo->grifo_receiver_stock_nuevo}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->