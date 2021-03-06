<div class="row">
    <!-- left column -->
  <div class="col-md-6">
    <form action="{{route('proveedores.store')}}" method="post">
    @csrf
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Datos Proveedor &nbsp;|  &nbsp;<b> Crear nuevo Proveedor</b></h3>
      </div><!-- /.box-header -->
        <div class="box-body">

          <div class="row">
            <div class="col-md-8">
              <div class="form-group @error('razon_social') has-error @enderror">
                <label for="razon_social">Razón Social*</label>
                <input id="razon_social" type="text" class="form-control" name="razon_social" placeholder="Ingrese la Razon Social" value="{{ old('razon_social') }}" required>
                @error('razon_social')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

            </div>

            <div class="col-md-4">
              <div class="form-group @error('ruc') has-error @enderror">
                <label for="ruc">RUC*</label>
                <input id="ruc" type="text" class="form-control" name="ruc" placeholder="Ingrese su RUC" value="{{ old('ruc') }}" pattern="[0-9]{11}" title="Formato: 11 dígitos" required>
                @error('ruc')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group @error('email') has-error @enderror">
                <label for="email">Correo Electrónico</label>
                <input id="email" type="email" class="form-control" name="email" placeholder="proveedor@ejemplo.com" value="{{ old('email') }}">
                @error('email')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>   
            </div>            
            <div class="col-md-6">
              <div class="form-group @error('linea_credito') has-error @enderror">
                <label for="linea_credito">Línea de Crédito</label>
                <input id="linea_credito" type="text" class="form-control" name="linea_credito" placeholder="Ingrese linea de crédito" value="{{ old('linea_credito') }}">
                @error('linea_credito')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>               
            </div>
            <div class="col-md-6">
              <div class="form-group @error('sobregiro') has-error @enderror">
                <label for="sobregiro">Sobregiro</label>
                <input id="sobregiro" type="text" class="form-control" name="sobregiro" placeholder="Ingrese Sobregiro" value="{{ old('sobregiro') }}">
                @error('sobregiro')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>               
            </div>            
          </div>                   
          </div><!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn pull-right btn-success">
            <i class="fa fa-plus"> </i>
              Registrar nuevo proveedor
          </button>
          
        </div><!-- /.box-footer -->

      </div><!-- /.box -->
    </form>
  </div>
    <!--/.col (left) -->

    @includeWhen(1==1,'proveedores.planta.create')

     <!--/.col (right) -->

</div> <!-- /.row-top -->


