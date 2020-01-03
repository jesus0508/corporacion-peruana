<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Lista de Grifos</h3>
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
            @foreach ($grifos as $grifo)
              <tr>
                <td>{{$grifo->ruc}}</td>
                <td>{{$grifo->razon_social}}</td>
                <td>{{$grifo->telefono}}</td>
                <td>{{$grifo->administrador}}</td>
                <td>{{$grifo->stock}}</td>
                <td>{{$grifo->distrito}}</td>
                
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->