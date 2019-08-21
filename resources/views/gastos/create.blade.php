<div class="row">
    <!-- left column -->
  <div class="col-md-4">
    <form action="{{route('proveedores.store')}}" method="post">
    @csrf
      <!-- general form elements -->
      <div class="box box-success collapse" id="collapseCategoria">
        <div class="box-header with-border">
          <h3 class="box-title">Nuevo gasto &nbsp;|&nbsp; <b>Nueva Categoria</b></h3>
      </div><!-- /.box-header -->
        <div class="box-body">


          <div class="form-group @error('categoria') has-error @enderror">
            <label for="categoria">Categoria </label>
            <input id="categoria" type="text" class="form-control" name="categoria" placeholder="Ejemplo: gastos operativos" value="{{ old('categoria') }}">
            @error('categoria')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>          
    

          </div><!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn pull-right btn-success disabled" >
            <i class="fa fa-plus"> </i>
              Agregar nueva categoria
          </button>
          
        </div><!-- /.box-footer -->

      </div><!-- /.box -->
    </form>
  </div>
    <!--/.col (left) -->
  <div class="col-md-8">
    <form action="{{route('proveedores.store')}}" method="post">
    @csrf
      <!-- general form elements -->
      <div class="box box-success collapse" id="collapseSubCategoria">
        <div class="box-header with-border">
          <h3 class="box-title">Nuevo gasto &nbsp;|  &nbsp;<b> Nueva Subcategoria</b></h3>
      </div><!-- /.box-header -->
        <div class="box-body">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group @error('categoria') has-error @enderror">
                <label for="categoria">Categoría Gasto</label>
                <select name="categoria" id="categoria" class="form-control">
                  <option value="">gastos operativos</option>
                  <option value="">gastos administrativos</option>
                  <option value="">otros</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group @error('subcategoria') has-error @enderror">
                <label for="subcategoria">Subcategoria*</label>
                <input id="subcategoria" type="text" class="form-control" name="subcategoria" placeholder="Ejemplo : gastos grifo" value="{{ old('subcategoria') }}"  required>
                @error('subcategoria')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              
            </div>
          </div>    
          </div><!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn pull-right btn-success disabled">
            <i class="fa fa-chain"> </i>
              Agregar nueva subcategoria
          </button>
          
        </div><!-- /.box-footer -->

      </div><!-- /.box -->
    </form>
  </div>
    <!--/.col (right) -->

</div> <!-- /.row-top -->
<div class="row">
  <div class="col-md-12">
  <div class="box box-success collapse" id="collapseGasto">
    <div class="box-header with-border">
      <h3 class="box-title">Nuevo gasto &nbsp;|&nbsp; <b>Nuevo Concepto GASTO</b></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group @error('categoria') has-error @enderror">
            <label for="categoria">Categoría Gasto</label>
            <select name="categoria" id="categoria" class="form-control">
              <option value="">gastos operativos</option>
              <option value="">gastos administrativos</option>
              <option value="">otros</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group @error('subcategoria') has-error @enderror">
            <label for="subcategoria">Categoría Gasto</label>
            <select name="subcategoria" id="subcategoria" class="form-control">
              <option value="">grifos</option>
              <option value="">cisternas</option>
              <option value="">otros</option>
            </select>
          </div>
        </div>          
        </div>        
      <div class="row">
        <div class="col-md-8">
          <div class="form-group @error('subcategoria') has-error @enderror">
            <label for="subcategoria">Concepto gasto*</label>
            <input id="subcategoria" type="text" class="form-control" name="subcategoria" placeholder="Ejemplo : Pago semanal" value="{{ old('subcategoria') }}"  required>
            @error('subcategoria')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>  
        </div>          
        <div class="col-md-4">
          <div class="form-group @error('codigo_gasto') has-error @enderror">
            <label for="codigo_gasto">Codigo gasto* autogenerado</label>
            <input id="codigo_gasto" type="text" class="form-control" name="codigo_gasto" placeholder="Codigo autogenerado" value="3011001"  required>
            @error('codigo_gasto')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>          
        </div>        
      </div> <!-- end- row-->
    </div><!-- end-bx-body-->
    <div class="box-footer">
      <button type="submit" class="btn pull-right btn-success disabled">
            <i class="fa fa-chain"> </i>
              Agregar nuevo gasto
      </button>
          
    </div><!-- /.box-footer -->
    
  </div> <!-- end- box-->
  </div>  
</div>


