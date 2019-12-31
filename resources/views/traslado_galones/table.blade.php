<div class="row">
	<div class="col-md-12">	
		<div class="box box-success">
			<div class="box-header with-border">
        <div class="row">
          <div class="col-md-3">
            <h2 class="box-title">Lista de Egresos</h2>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="">Fecha a filtrar</label>
              <input autocomplete="off" id="fecha_inicio" type="text" class="form-control" name="fecha" placeholder="Fecha" >
            </div>  
          </div>
          <div class="col-md-6">
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
	                <th>Tipo </th>
	                <th>Cliente|Grifo</th>
	                <th>Stock</th>
	                <th>Proveedor</th>
	                <th>Horario</th>
	                <th>Cantidad</th>
	                <th>Nuevo stock</th>
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
	                  <td>{{$traslado->stock}}</td>
	                  <td>{{$traslado->proveedor->razon_social}}</td>
	                  <td>{{$traslado->horario}}</td>
	                  <td>{{$traslado->cantidad}}</td>
	                  <td>{{$traslado->nuevo_stock}}</td>
	            </tr>
	          @endforeach
	          </tbody>
	      </table>
	    </div>  {{-- end.box-body --}}
		</div>  {{-- end.box --}}
	</div>
</div>