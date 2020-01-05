<div class="row">
	<div class="col-md-12">	
		<div class="box box-success">
			<div class="box-header with-border">
        <div class="row">
					<div class="col-md-4">
				    <div class="input-group">
				      <span class="input-group-addon">Tipo</span>
				      <select class="form-control" id="filter-tipo">
				          <option value="1">Grifo</option>
				          <option value="2">Cliente</option>
				      </select>
				    </div><!-- /input-group -->
					</div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="">Fecha a filtrar</label>
              <input autocomplete="off" id="fecha_inicio" type="text" class="form-control" name="fecha" placeholder="Fecha" >
            </div>  
          </div>
          <div class="col-md-4">
            <button class="btn btn-info" id="filtrar-fecha"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp; Filtrar</button>

          	<button id="clear-fecha" class="btn btn-danger">
            <i class="fa fa-remove "></i>
            Limpiar
      		</button>
          </div>        
        </div> 
			</div>
	    <div class="box-body">
	      <table id="tabla-traslado-galones" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
	        <thead>
	              <tr>
	                <th>#</th>
	                <th>Fecha</th>
	                <th>Tipo</th>
	                <th>Proveedor</th>
	                <th>Cantidad galones</th>
	              </tr>
	        </thead>
	        <tbody>
	          @foreach ($traslados as $traslado)
	            <tr>
	                  <td>{{$loop->iteration}}</td>
	                  <td>{{$traslado->fecha}}</td>
	                  <td>{{$traslado->getTipo()}}</td>
	                  <td>
	                  	@if($traslado->tipo ==1)
	                  		{{$traslado->grifo->razon_social}}
	                  	@else
	                  		{{$traslado->cliente->razon_social}}
	                  	@endif
	                  </td>
	                  <td>{{$traslado->cantidad}}</td>
	            </tr>
	          @endforeach
	          </tbody>
	          <tfoot>
	          	<th colspan="4" style="text-align: right;">Total</th>
	          	<th></th>
	          </tfoot>
	      </table>
	    </div>  {{-- end.box-body --}}
		</div>  {{-- end.box --}}
	</div>
</div>