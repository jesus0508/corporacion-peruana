<div class="container">
	<div class="row">
		<form class="" action="{{route('depositos.store')}}" method="post">
    @csrf
		<div class="col-md-6">
			<div class="box box-success">
				<div class="box-header with-border">
					 <h3 class="box-title">Depositos Registro</h3>
				</div>	
				<div class="box-body">
					<div class="form-group">
						<label for="razon_social">
						 Banco - Número de Cuenta *
						</label>
						<select name="cuenta_id" id="" class="form-control">
							@foreach($cuentas as $cuenta)
							<option value="{{$cuenta->id}}">{{$cuenta->nro_cuenta}}</option>
							@endforeach							
						</select>			
					</div>
					<div class="form-group">
						<label for="detalle">
								Detalles
						</label>
						<input type="text" name="detalle" 
							placeholder="Ingrese detallles" class="form-control">				
					</div>
					<div class="form-group">
						<label for="codigo_operacion">
								Código de Operación
						</label>
						<input type="text" name="codigo_operacion"
							placeholder="Ingrese el Código de Operación " class="form-control">				
					</div>
					<div class="form-group">
						<label for="fecha_reporte">
								Fecha Reporte Depósito
						</label>
						<input type="date" name="fecha_reporte"
							placeholder="Ingrese la fecha " class="form-control">				
					</div>
					<div class="form-group">
						<label for="monto">
								 Monto
						</label>
						<input type="text" name="monto" 
							placeholder="Monto" class="form-control">				
					</div>				
				</div>
				<div class="box-footer">
						<button class="btn btn-primary pull-right">Guardar</button>
				</div>
			</div>	 <!-- end-box.success		 -->
		</div>		
		</form>					
		<div class="col-md-6">
			
		</div>		
	</div>	
</div>