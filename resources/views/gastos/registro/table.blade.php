<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Gastos Registrados</h2>

        <input type="button"  class="btn btn-primary pull-right" value="Actualizar Registros" 
        onclick = "location.reload()">
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-gastos-registro" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Categoria</th>
              <th>Subcategoria</th>
              <th>Gasto Descripcion</th>
              <th>Fecha</th>
              <th>Monto</th>
              <th>Grifo</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $egresos as $egreso )
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$egreso->categoria}}</td>
                <td>{{$egreso->subcategoria}}</td>
                <td>{{$egreso->concepto}}</td>
                <td>{{$egreso->fecha_egreso}}</td>
                <td>{{$egreso->monto_egreso}}</td>
                <td>{{$egreso->grifo}}</td>               
                <td> <label for="" class="label">estado</label>
                </td>  
              </tr>            
            @endforeach
          

          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->