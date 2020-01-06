<div class="row">
	<div class="col-md-12">	
		<div class="box box-success">
			<div class="box-header with-border">
        <div class="row">
          <div class="col-md-3">
            <h2 class="box-title">Buscar por fecha Mensual: </h2>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="">Fecha a filtrar</label>
              <input autocomplete="off" id="fecha_inicio" value="" type="text" class="form-control" name="fecha" placeholder="Fecha" >
            </div>  
          </div>
          <div class="col-md-6">
            <button class="btn btn-info" id="filtrar-fecha"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp; Filtrar</button>

{{--           	<button id="clear-fecha" class="btn btn-danger">
            <i class="fa fa-remove "></i>
            Limpiar
      		</button> --}}
          </div>        
        </div> 
			</div>
	    <div class="box-body">
	      <table id="tabla-traslado-galones" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
	        <thead>
	              <tr>
	                <th>Fecha</th>
	                <th>Proveedor</th>
	                <th>Grifos(galones)</th>
	                <th>Clientes(galones)</th>
	                <th>Subtotal </th>
	              </tr>
	        </thead>
	        <tbody></tbody>
	        <tfoot>
	        	<tr>
	        		<th></th>
	        		<th>Totales</th>
	        		<th></th>
	        		<th></th>
	        		<th style="color:red"></th>
	        	</tr>
	        </tfoot>
	      </table>
	    </div>  {{-- end.box-body --}}
		</div>  {{-- end.box --}}
	</div>
</div>