<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Historial de balanceos</h3>
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
                <td>{{$balanceo->grifo_id_sender}}</td>
                <td>{{$balanceo->grifo_sender_stock_nuevo}}</td>
                <td>{{$balanceo->cantidad}}</td>
                <td>{{$balanceo->grifo_id_receiver}}</td>
                <td>{{$balanceo->grifo_receiver_stock_nuevo}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->