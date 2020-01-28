<div class="row">
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-success " id="">
        <div class="box-header with-border">
          <h3 class="box-title">GASTO   &nbsp;|  &nbsp;<b>  AGREGAR & EDITAR & ELIMINAR</b></h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group @error('concepto') has-error @enderror">
                <label for="concepto"> Gasto Descripción</label>
                  <select name="concepto" id="concepto" class="form-control">  
                  </select>
              </div>
            </div>   
            <div class="col-md-4"> 
              <div class="form-group"> 
                <label for="" > ACCIONES</label>
                <div class="control">
                  <button id="btn_concepto_add"  class="btn btn-primary" data-toggle="modal" data-target="#modal-add-concepto"
                  ><span class="fa fa-plus"> </span> &nbsp;Agregar</button>
                    <!-- edit -->
                  <button id="btn_concepto_edit"  class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-concepto"
                          disabled=""> <input type="hidden" id="cod_concepto_edit">
                    <span class="glyphicon glyphicon-edit"></span>
                  </button>
                  <!-- edit end -->
                    <form style="display:inline" method="POST" onsubmit="return confirmar('la categoria')" action="{{ route('concepto_gastos.destroy',0) }}">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" id="id_concepto_delete" name="id">
                        <button disabled id="btn_concepto_delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;</button>
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
          <h3 class="box-title"> Código  &nbsp;|&nbsp; <b>DESCRIPCIÓN GASTO</b></h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="form-group @error('categoria') has-error @enderror">
            <label for="categoria">Código </label>
            <input type="text" class="form-control" id="cod_concepto_right" readonly="">              
          </div>        
        </div><!-- /.box-body -->
      </div><!-- /.box -->
  </div>    <!--/.col (right) -->

    <!--/.col (left) -->

</div> <!-- /.row-top -->



