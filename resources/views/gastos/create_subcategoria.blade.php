<div class="row">
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-success " id="">
        <div class="box-header with-border">
          <h3 class="box-title">Sub-Categoría     &nbsp;|  &nbsp;<b>  REGISTRAR & ELIMINAR</b></h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group @error('subcategoria') has-error @enderror">
                <label for="subcategoria">Sub-Categoría Gasto</label>
                  <select name="subcategoria" id="subcategoria" class="form-control">
  
                  </select>
              </div>
            </div>

            <div class="col-md-4"> 
              <div class="form-group"> 
                <label for="" > ACCIONES</label>
                <div class="control">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add-subcategoria" data-cod="{{$new_codigo_subcategoria}}"><span class="fa fa-plus"> </span> &nbsp;Agregar</button>
                    <!-- edit -->
                  <button id="btn_subcategoria_edit"  class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-subcategoria"
                          disabled=""> <input type="hidden" id="cod_subcategoria_edit">
                    <span class="glyphicon glyphicon-edit"></span>
                  </button>
                  <!-- edit end -->
                  <form style="display:inline" method="POST" action="{{ route('sub_categoria_gastos.destroy',0) }}">
                    @csrf
                    @method('DELETE')
                      <button disabled id="btn_subcategoria_delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;</button>
                  </form>
                </div>                  
              </div>
            </div>
<!--             <div class="col-md-3"> 
              <button>Eliminar</button>
            </div> -->
          </div>    
          </div><!-- /.box-body -->
      </div><!-- /.box -->
  </div>   <!-- left column -->
  <div class="col-md-4">
      <!-- general form elements -->
      <div class="box box-success" id="">
        <div class="box-header with-border">
          <h3 class="box-title"> Código  &nbsp;|&nbsp; <b>SUB-CATEGORÍA</b></h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="form-group @error('categoria') has-error @enderror">
            <label for="categoria">Código </label>
            <input type="text" class="form-control" id="cod_subcat_right" readonly="">              
          </div>        
        </div><!-- /.box-body -->
      </div><!-- /.box -->
  </div>    <!--/.col (right) -->

    <!--/.col (left) -->

</div> <!-- /.row-top -->



