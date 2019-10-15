<div class="">
	<div class="row">
		<div class="col-md-6">
			<form action="{{route('empresa.update',$empresa->id)}}" method="post">
				@csrf
				@method('PUT')
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
			</form>
		</div>			
		<div class="col-md-6">
			<div class="box box-success">
					<div class="box-header with-border">
						 <h3 class="box-title">Información Bancos</h3>
					</div>	
					<div class="box-body">
						@foreach( $bancos as $banco )
						<div class="col-md-6" style="border-style: groove;">
							<div class="pull-left">
								<label for="banco">{{$banco->abreviacion}}</label>
								<p>&nbsp;Cuentas: &nbsp;<span class="label label-success">{{$banco->total_cuentas}}</span></p>
							</div>							
							<div class="pull-right">
								<a href="{{route('bancos.show',$banco->id)}}" class="btn btn-xs btn-primary"><span class="fa fa-bank"></span>&nbsp; Administrar </a>	
								@if( $banco->total_cuentas == 0 )
                    <form style="display:inline" method="POST" action="{{ route('bancos.destroy', $banco->id) }}">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                @endif
								
							</div>								 
						</div>	
						@endforeach
									
					</div>
					<div class="box-footer">						
                            
							<button class="btn btn-success pull-right"  data-toggle="modal" data-target="#modal-add-banco"> <span class="fa fa-plus"></span> &nbsp;Agregar nuevo Banco</button>
					</div>
			</div>
		</div>		
	</div>	
</div>