<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de Gasto Descripción</h2>
        <div class="row">
          <div class="col-md-4">
            
          </div>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">Categoria</span>
              <select class="form-control" id="filter-categoria" >
                @foreach( $categorias as $categoria )
                  <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                @endforeach
              </select>
            </div><!-- /input-group -->
          </div>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">Subcategoria</span>
              <select class="form-control" id="filter-sub-categoria">
                @foreach( $subcategorias as $subcategoria )
                  <option value="{{$subcategoria->id}}">{{$subcategoria->subcategoria}}</option>
                @endforeach
              </select>
            </div><!-- /input-group -->
          </div>
        </div>          
      </div><!-- /.box-header -->
      <div class="box-body" id="div-table">
        <table id="tabla-lista-egresos-plantilla" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Categoria</th>
              <th>Subcategoria</th>
              <th>Gasto Descripcion</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($concepto_gastos as $concepto)
              <tr>
                <td>{{$concepto->codigo}}</td>
                <td>{{$concepto->subCategoriaGasto->categoriaGasto->categoria}}</td>
                <td>{{$concepto->subCategoriaGasto->subcategoria}} </td>
                <td>{{$concepto->concepto}} </td>
                <td>
                 <button class="btn btn-xs btn-warning" 
                    data-toggle="modal" data-cod="{{$concepto->id}}" data-target="#modal-edit-concepto">                  
                    <span class="glyphicon glyphicon-edit"></span>
                  </button>
                  @if(count($concepto->egresos)==0)
                    <form style="display:inline" method="POST"
                     onsubmit="return confirmar('el gasto')" 
                     action="{{ route('concepto_gastos.destroy',$concepto->id) }}">
                      @csrf
                      @method('DELETE')
                        <button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;</button>
                    </form>
                  @endif
                </td>  
              </tr>
            @endforeach
             
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->