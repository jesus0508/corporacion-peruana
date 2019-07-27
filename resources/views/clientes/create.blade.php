<form action="{{route('proveedores.store')}}" method="post">
  @csrf
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Datos principales*</h3>
        </div><!-- /.box-header -->
        {{-- <form role="form"> --}}
          <div class="box-body">
               <div class="form-group @error('razon_social') has-error @enderror">
              <label for="razon_social">Razon Social*</label>
              <input id="razon_social" type="text" class="form-control" name="razon_social" placeholder="Ingrese la Razon Social" required>
              @error('razon_social')
            <span class="help-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
            <div class="form-group">
                <label for="ruc">RUC*</label>
               <input id="ruc" type="text" class="form-control" name="ruc" placeholder="Ingrese  el ruc del proveedor">           
            </div>

          
            
         
         
          </div><!-- /.box-body -->
        {{-- </form> --}}
      </div><!-- /.box -->
    </div>
    <!--/.col (left) -->
 
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
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
         
        


            

          </div><!-- /.box-body -->
        {{-- </form> --}}
      </div><!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div> <!-- /.row-top -->
  <div class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-lg btn-success">
        <i class="fa fa-plus-square-o"> </i>
        Registrar nuevo proveedor
      </button>
    </div>
  </div> <!-- /.row-bottom -->
</form>
