<form action="{{route('pedidos.store')}}" method="post">
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
            <div class="form-group @error('nro_pedido') has-error @enderror">
              <label for="numero_pedido">Numero Pedido</label>
              <input id="numero_pedido" type="number" class="form-control" name="nro_pedido" placeholder="Ingrese el número de pedido" min="0" required>
              @error('nro_pedido')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror

            </div>
            <div class="form-group @error('scop') has-error @enderror">
              <label for="scop_pedido">SCOP</label>
              <input id="scop_pedido" type="number" class="form-control" name="scop" placeholder="Ingrese el SCOP" min="0" required>
              @error('scop')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">

                 <label for="planta">Planta</label>
                  <select class="form-control" id="planta" name="planta_id" required>
                    @foreach ( $plantas as $planta)
                      <option value="{{$planta->id}}">{{$planta->planta}}</option>
                    @endforeach
                  </select>

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
          <h3 class="box-title"><b> DIESEL B5 (S50) UV</b> </h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        {{-- <form role="form"> --}}
          <div class="box-body">
            <div class="form-group @error('galones') has-error @enderror">
                <label for="galones">Cantidad de galones del pedido</label>
               <input id="galones" type="number" class="form-control" name="galones" placeholder="Ingrese  cantidad de galones" min="0" max="99999" required>
              @error('galones')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
           
            </div>
            <div class="form-group @error('costo_galon') has-error @enderror">
              <label for="costo_galon">Precio del galón</label>
              <input id="costo_galon" type="text" class="form-control" name="costo_galon" placeholder="Ingrese precio actual del galon" pattern="(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{5}))?)" title="Formato: Use 5 decimales" required>
              @error('costo_galon')
              <span class="help-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="proveedor">Proveedor</label>
              <input id="proveedor" type="text" class="form-control" name="proveedor" placeholder="Proveedor" disabled>
            </div>            

        

          </div><!-- /.box-body -->
        {{-- </form> --}}
      </div><!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div> <!-- /.row-top -->
  <div class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-lg btn-success pull-right">
        <i class="fa fa-plus-square-o"> </i>
        Registrar nuevo Pedido
      </button>
    </div>
  </div> <!-- /.row-bottom -->
</form>
