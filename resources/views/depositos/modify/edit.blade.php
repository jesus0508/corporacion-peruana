<div class="modal fade" id="modal-edit-deposito" style="display: none;">
  <div class="modal-dialog modal-lg">
	<form class="modal-content" action="{{route('depositos.update',0)}}" method="post">
      @csrf
      @method('PUT')
      <input type="hidden" id="id-edit" name="id">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar datos del cliente</h4>
      </div>
      <div class="modal-body">

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
									 Banco - Número de Cuenta 
									</label>
									<select name="cuenta_id" id="cuenta_id" class="form-control" required="">					
									</select>			
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group @error('detalle') has-error @enderror">
									<label for="detalle">
											Detalles
									</label>
									<input type="text" name="detalle" id="detalle" 
										placeholder="Ingrese detallles" class="form-control" value="{{old('detalle')}}">
										@error('detalle')
			                <span class="help-block" role="alert">
			                  <strong>{{ $message }}</strong>
			                </span>
		                @enderror				
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group @error('codigo_operacion') has-error @enderror">
									<label for="codigo_operacion">
											Código de Operación*
									</label>
									<input type="text" name="codigo_operacion" id="codigo_operacion" value="{{old('codigo_operacion')}}"
										placeholder="Ingrese el Código de Operación " class="form-control" required="">	
										@error('codigo_operacion')
			                <span class="help-block" role="alert">
			                  <strong>{{ $message }}</strong>
			                </span>
		                @enderror			
								</div>	
							</div>
							<div class="col-md-4">
								<div class="form-group @error('fecha_reporte') has-error @enderror">
									<label for="fecha_reporte">
											Fecha Reporte Depósito*
									</label>
									<input autocomplete="off" id="fecha_reporte" type="text"
									 class="tuiker form-control" value="{{old('fecha_reporte')}}"
                        name="fecha_reporte" placeholder="Fecha" required="">		
                    @error('fecha_reporte')
			                <span class="help-block" role="alert">
			                  <strong>{{ $message }}</strong>
			                </span>
		                @enderror		
								</div>								
							</div>
							<div class="col-md-4">
								<div class="form-group @error('monto') has-error @enderror">
									<label for="monto">
											 Monto*
									</label>
									<input type="number" name="monto" id="monto" step="any" min="0" 
										placeholder="Monto" class="form-control" required="">	
										@error('monto')
			                <span class="help-block" role="alert">
			                  <strong>{{ $message }}</strong>
			                </span>
		                @enderror				
								</div>
							</div>								
						</div>				
					</div>	{{-- box.body --}}
				</div>	 <!-- end-box.success		 -->
			</div>	
		</div> {{-- end.row --}}	
		</div> {{-- modal.body	 --}}
		<div class="modal-footer">
      <button type="submit" class="btn btn-success pull-left">Guardar cambios</button>
      <button type="" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    </div>
	</form>	{{-- modal-content --}}
  </div><!-- /.modal-dialog -->
</div>