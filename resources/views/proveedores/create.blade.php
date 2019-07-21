<form action="{{route('proveedores.store')}}" method="post">
  @csrf
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Datos principales*</h3>
        </div><!-- /.box-header -->
        {{-- <form role="form"> --}}
          <div class="box-body">
               <div class="form-group @error('razon_social') has-error @enderror">
              <label for="razon_social">Razon Social</label>
              <input id="razon_social" type="text" class="form-control" name="razon_social" placeholder="Ingrese la Razon Social" required>
              @error('razon_social')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>

            <div class="form-group">
              <label for="direccion">Dirección</label>
              <input id="direccion" type="text" class="form-control" name="direccion" placeholder="Ingrese direccion" required>
            </div>
         
          </div><!-- /.box-body -->
        {{-- </form> --}}
      </div><!-- /.box -->
    </div>
    <!--/.col (left) -->
  
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Datos secundarios</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        {{-- <form role="form"> --}}
          <div class="box-body">
            <div class="form-group">
                <label for="representante">Representante</label>
               <input id="representante" type="text" class="form-control" name="representante" placeholder="Ingrese  representate">
           
            </div>
            <div class="form-group  @error('celular') has-error @enderror">
              <label for="celular">Celular Representante</label>
              <input id="celular" type="text" class="form-control" name="celular" placeholder="Ingrese celular">
              @error('celular')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
          </div><!-- /.box-body -->
        {{-- </form> --}}
      </div><!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div> <!-- /.row-top -->
  <div class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-lg btn-primary">
        <i class="fa fa-plus-square-o"> </i>
        Registrar nuevo proveedor
      </button>
    </div>
  </div> <!-- /.row-bottom -->
</form>
