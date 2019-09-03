<div class="row">
    <div class="col-md-8">
    <form action="{{route('proveedores.store')}}" method="post">
    @csrf
      <!-- general form elements -->
      <div class="box box-success " id="">
        <div class="box-header with-border">
          <h3 class="box-title">Categoría     &nbsp;|  &nbsp;<b>  REGISTRAR & ELIMINAR</b></h3>
      </div><!-- /.box-header -->
        <div class="box-body">

          <div class="row">
            <div class="col-md-8">
              <div class="form-group @error('categoria') has-error @enderror">
                <label for="categoria">Categoría Gasto</label>
                  <select name="categoria" id="categoria" class="form-control">
                    <option value="">grifos</option>
                    <option value="">cisternas</option>
                    <option value="">otros</option>
                  </select>
              </div>
            </div>

            <div class="col-md-4"> 
              <div class="form-group"> 
                <label for="" > ACCIONES</label>
                <div class="control">
                  <button class="btn btn-primary"><span class="fa fa-plus"> </span> &nbsp;Agregar</button>
                  <button class="btn btn-danger"><span class="fa fa-trash"> </span> &nbsp;Eliminar</button> 
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
          <div class="form-group @error('categoria') has-error @enderror">
            <label for="categoria">Código </label>
            <input type="text" class="form-control" value="100" readonly="">              
          </div>        
        </div><!-- /.box-body -->
      </div><!-- /.box -->
  </div>    <!--/.col (right) -->

    <!--/.col (left) -->

</div> <!-- /.row-top -->



