<div class="">	
	<form class="" action="{{route('depositos.store')}}" method="post">
    @csrf
    <div class="row">
			<div class="col-md-12">
				<div class="box box-success">
					<div class="box-header with-border">
						 <h3 class="box-title">Registro Depósitos</h3>
					</div>	
					<div class="box-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="razon_social">
									 Banco - Número de Cuenta *
									</label>
									<select name="cuenta_id" id="cuenta_id" class="form-control">
										@foreach($cuentas as $cuenta)
										<option value="{{$cuenta->id}}">{{$cuenta->nro_cuenta}}</option>
										@endforeach							
									</select>			
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<label for="detalle">
											Detalles
									</label>
									<input type="text" name="detalle" 
										placeholder="Ingrese detallles" class="form-control">				
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="codigo_operacion">
											Código de Operación*
									</label>
									<input type="text" name="codigo_operacion"
										placeholder="Ingrese el Código de Operación " class="form-control" required="">				
								</div>	
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="fecha_reporte">
											Fecha Reporte Depósito*
									</label>
									<input autocomplete="off" id="fecha_reporte" type="text" class="tuiker form-control"
                        name="fecha_reporte" placeholder="Fecha" required="">			
								</div>								
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="monto">
											 Monto*
									</label>
									<input type="text" name="monto" 
										placeholder="Monto" class="form-control" required="">				
								</div>
							</div>								
						</div>				
					</div>
					<div class="box-footer">
							<button class="btn btn-primary pull-right">Guardar</button>
					</div>
				</div>	 <!-- end-box.success		 -->
			</div>	
		</div>			
	</form>	
</div>