<div class="row">
	<div class="col-md-12">	
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Listado:</h3>			
			</div>
	    <div class="box-body">
	      <table id="tabla-traslado-galones" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
	        <thead>
	              <tr>
	                <th>#</th>
	                <th>Tipo </th>
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
	                  <td>{{$traslado->getTipo()}}</td>
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