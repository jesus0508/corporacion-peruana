<form action="{{route('clientes.store')}}" method="post">
  @csrf
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Datos principales</h3>
        </div><!-- /.box-header -->
        {{-- <form role="form"> --}}
          <div class="box-body">
            <div class="form-group">
              <label for="ruc">RUC</label>
              <input id="ruc" type="text" class="form-control" name="ruc" placeholder="Ingrese su RUC">
            </div>
            <div class="form-group">
              <label for="razon_social">Razon Social</label>
              <input id="razon_social" type="text" class="form-control" name="razon_social" placeholder="Ingrese la Razon Social">
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
              <label for="tipo">Tipo</label>
              <select id="tipo" class="form-control" name="tipo">
                  <option value="1">Grifo</option>
                  <option value="2">Normal</option>
              </select>
            </div>
            <div class="form-group">
              <label for="direccion">Direccion</label>
              <input id="direccion" type="text" class="form-control" name="direccion" placeholder="Ingrese la direccion">
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
        Registrar nuevo cliente
      </button>
    </div>
  </div> <!-- /.row-bottom -->
</form>
