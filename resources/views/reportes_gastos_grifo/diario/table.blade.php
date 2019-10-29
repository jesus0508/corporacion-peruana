<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
        <table id="tabla-gastos-grifo-diarios" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha</th>
              <th>Grifo</th>
              <th>Categoria</th>
              <th>Subcategoria</th>
              <th>Gasto Descripcion</th>
              <th>Monto (S/.)</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $egresos as $egreso )
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{date('d/m/Y', strtotime($egreso->fecha_egreso))}}</td>
                <td>{{$egreso->grifo}}</td>                  
                <td>{{$egreso->categoria}}</td>
                <td>{{$egreso->subcategoria}}</td>
                <td>{{$egreso->concepto}}</td>
                <td>{{$egreso->monto_egreso}}</td>
              </tr>            
            @endforeach        

          </tbody>
            <tfoot>
            <tr>
                <th colspan="6" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->