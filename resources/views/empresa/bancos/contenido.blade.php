<div class="col-md-6 collapse" id="collapseCuenta">
	<form action="{{route('cuentas.store')}}" method="post">
		@csrf		
		<input type="hidden" name="abreviacion" value="{{$banco->abreviacion}}">
		<input type="hidden" name="banco_id" value="{{$banco->id}}">
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">
						<b>Registrar nueva Cuenta  </b>
					</h3>
				</div>	
				<div class="box-body">						
					<div class="form-group">
						<label for="nro_cuenta">
							Número de Cuenta
						</label>
						<input type="text" name="nro_cuenta" 							 
							placeholder="Ingrese el número de cuenta" class="form-control">				
					</div>
					<div class="form-group">
						<label for="tipo">
							Tipo de moneda
						</label>
						<select name="tipo" id="" class="form-control">							
								<option value="Soles">Soles</option>
								<option value="Dolares">Dolares</option>							
						</select>				
					</div>
					<button class="btn btn-success pull-right"><span class="fa fa-plus"></span>
					&nbsp;Registrar</button>
				</div>
			</div>	 <!-- end-box.success		 -->
		</form>									
	</div>		
@foreach($banco->cuentas as $cuenta )
	<div class="col-md-6">				
		<div class="box box-success">			
			<div class="box-header with-border">
					<h3 class="box-title">Información Cuenta 
					<span>{{$loop->iteration}}</span></h3>
			</div>	
			<div class="box-body">
				<form action="{{route('cuentas.update',$cuenta->id)}}" method="post">
					@csrf
					@method('PUT')		
					<input type="hidden" name="abreviacion" value="{{$banco->abreviacion}}">						
					<div class="form-group">
							<label for="nro_cuenta">
								Número de Cuenta
							</label>
							<input type="text" name="nro_cuenta" 
								value="{{explode(' ', $cuenta->nro_cuenta)[1]}}" 
								placeholder="Ingrese el número de Cuenta" class="form-control">				
					</div>
					<div class="form-group">
							<label for="tipo">
								Tipo de moneda
							</label>
							<select name="tipo" id="" class="form-control">
								@if( 'Soles' == $cuenta->tipo )
									<option value="Soles" selected="">Soles</option>
									<option value="Dolares">Dolares</option>
								@else
								<option value="Soles">Soles</option>
									<option value="Dolares" selected="">Dolares</option>
								@endif
							</select>				
					</div>		
					<button class="btn btn-primary pull-right"> Guardar</button>
				</form>
				<form style="display:inline" method="POST" action="{{ route('cuentas.destroy', $cuenta->id) }}">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger pull-left">
            <span class="glyphicon glyphicon-trash"></span>
              Eliminar
          </button>
        </form>
				</div>
			</div>	 <!-- end-box.success		 -->
		</form>									
	</div>		
@endforeach
