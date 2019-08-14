@foreach($plantas as $planta)
@if( $loop->iteration % 2 != 0 )
<div class="row">
@endif
  <div class="col-md-6">
      <!-- general form elements -->
    <div class="box box-success">      
      <div class="box-header with-border">
        <h3 class="box-title">Planta Número <span> {{$loop->iteration}}</span></h3>
      </div><!-- /.box-header -->

      <div class="box-body">
        <form action="{{ route('planta.update',0) }}" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" value="{{$planta->id}}">
          <input type="hidden" name="proveedor_id" value="{{$planta->proveedor_id}}">

        <div class="row">
          <div class="col-md-12">
            <div class="form-group @error('planta') has-error @enderror">
              <label for="planta">Nombre de la planta*</label>
              <input id="planta" type="text" class="form-control" name="planta" placeholder="Ingrese la Razon Social"  value="{{old('planta'.$planta->planta,$planta->planta) }}" >
              @error('planta')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group @error('direccion_planta') has-error @enderror">
              <label for="direccion_planta">Dirección de la planta</label>
              <input id="direccion_planta" type="text" class="form-control" name="direccion_planta" placeholder="Ingrese la Dirección de la planta" value="{{ old('direccion_planta'.$planta->direccion_planta, $planta->direccion_planta) }}" >
              @error('direccion_planta')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>            
          </div>
          <div class="col-md-6">
            <div class="form-group @error('celular_planta') has-error @enderror">
              <label for="celular_planta">Celular de la planta</label>
              <input id="celular_planta" type="number" class="form-control" name="celular_planta" placeholder="Ingrese el celular de la planta" value="{{ old('celular_planta'.$planta->celular_planta, $planta->celular_planta) }}" title="Formato: 11 dígitos" min="900000000" max="999999999">
              @error('celular_planta')
                <span class="help-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>  
            
          </div>
        </div>
          <button type="submit" class="btn pull-left btn-success">
            <i class="fa fa-pencil"> </i>
              Guardar Cambios 
          </button>
    </form>

        <form style="display:inline" method="POST" action="{{ route('planta.destroy', $planta->id) }}">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger pull-right">
            <span class="glyphicon glyphicon-trash"></span>
              Eliminar
          </button>
        </form>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
  
@if( $loop->iteration % 2 == 0 )
</div>
@endif
@endforeach



    <!--/.col (right) -->


