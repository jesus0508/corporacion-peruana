<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-success">
				<div class="box-header with-border">
					 <h3 class="box-title">Información General</h3>
				</div>	
				<div class="box-body">
					<div class="form-group">
						<label for="razon_social">
								Razón Social
						</label>
						<input type="text" name="razon_social" value="{{$empresa->razon_social}}" 
							placeholder="Ingrese la Razón Social" class="form-control">				
					</div>
					<div class="form-group">
						<label for="ruc">
								RUC
						</label>
						<input type="text" name="ruc" value="{{$empresa->ruc}}"
							placeholder="Ingrese el RUC" class="form-control">				
					</div>
					<div class="form-group">
						<label for="direccion">
								DIRECCIÓN
						</label>
						<input type="text" name="direccion" value="{{$empresa->direccion}}"
							placeholder="Ingrese la dirección" class="form-control">				
						</div>				
				</div>
				<div class="box-footer">
						<button class="btn btn-primary pull-right">Guardar</button>
				</div>
			</div>	 <!-- end-box.success		 -->
		</div>			
		<div class="col-md-6">
			<h3>LISTA BANCOS CON CUENTAS...</h3>
		</div>		
	</div>	
</div>