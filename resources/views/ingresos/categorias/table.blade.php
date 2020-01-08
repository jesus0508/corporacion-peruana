<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de categorías de ingresos</h2>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-ingreso_grifos" class="table table-bordered table-striped responsive display nowrap">
          <thead>
            <tr>
              <th>#</th>
              <th>Categoria Ingreso</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($categorias as $categoria)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$categoria->categoria}}</td>
                <td>
                  @if(   count( $categoria->ingresos )      == 0 
                    &&  count( $categoria->ingresoGrifos ) == 0
                    &&  count( $categoria->pagoClientes)   == 0   )
                  <form style="display:inline" method="POST" action="{{ route('categoria_ingresos.destroy', $categoria->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Eliminar</button>
                  </form>
                  @else
                  <form style="display:inline" method="POST" action="{{ route('categoria_ingresos.destroy', $categoria->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" disabled><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Eliminar</button>
                  </form>
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