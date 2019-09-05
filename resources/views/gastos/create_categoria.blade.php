<div class="row">
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-success " id="">
        <div class="box-header with-border">
          <h3 class="box-title">Categoría     &nbsp;|  &nbsp;<b>  REGISTRAR & ELIMINAR</b></h3>
      </div><!-- /.box-header -->
        <div class="box-body">

          <div class="row">
            <div class="col-md-7">
              <div class="form-group">
                <label for="categoria">Categoría Gasto</label>
                  <select name="categoria" id="categoria" class="form-control">
                    @foreach( $categorias as $categoria )
                      <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                    @endforeach
                  </select>
              </div>
            </div>

            <div class="col-md-5"> 
              <div class="form-group"> 
                <label for="" > ACCIONES</label>
                <div class="control">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add-categoria" data-cod="{{$new_codigo_categoria}}"><span class="fa fa-plus"> </span> &nbsp;Agregar</button>
                    <!-- edit -->
                  <button id="btn_categoria_edit"  class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-categoria"
                          > <input type="hidden" id="cod_categoria_edit">
                    <span class="glyphicon glyphicon-edit"></span>
                  </button>
                  <!-- edit end -->
                  @if( count($subcategorias) == 0 )   
                  <form style="display:inline" method="POST" action="{{ route('categoria_gastos.destroy',0) }}">
                    @csrf
                    @method('DELETE')
                      <input type="hidden" id="id_cat_delete" name="id">
                      <button id="btn_categoria_delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;<small>Eliminar todo</small></button>
                  </form>
                  @endif
                </div>                  
              </div>
            </div>
<!--             <div class="col-md-3"> 
              <button>Eliminar</button>
            </div> -->
          </div>    
          </div><!-- /.box-body -->
      </div><!-- /.box -->
    </form>
  </div>   <!-- left column -->
  <div class="col-md-4">
      <!-- general form elements -->
      <div class="box box-success" id="">
        <div class="box-header with-border">
          <h3 class="box-title">Código &nbsp;|&nbsp; <b>CATEGORÍA</b></h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <label for="cod_right">Código </label>
            <input type="text" id="cod_cat_right" class="form-control" readonly="">              
          </div>        
        </div><!-- /.box-body -->
      </div><!-- /.box -->
  </div>    <!--/.col (right) -->

    <!--/.col (left) -->

</div> <!-- /.row-top -->



