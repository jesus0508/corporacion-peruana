<div class="modal fade" id="modal-add-serie" style="display: none;">
  <div class="modal-dialog">
  	<form class="" action="{{route('series.store')}}" method="post">
    @csrf
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span></button>
	        <h4 class="modal-title">Agregar nueva Serie</h4>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	          <!-- left column -->
	          <div class="col-md-12">
	            <!-- general form elements -->
	            <div class="box box-success">
	              <div class="box-header with-border">
	                <h3 class="box-title">Nueva Serie </h3>
	              </div><!-- /.box-header -->
	              <div class="box-body">
	              	<input type="hidden" name="serie" value="0">
<!-- 	                <div class="form-group">
	                  <label for="serie-add">Nombre Serie</label>
	                  <input id="serie-add" type="text" name="serie" class="form-control" placeholder="Ejemplo: Serie 016" required="">
	                </div> -->
	                <div class="form-group">
	                  <label for="nro-add">Número Serie</label>
	                  <input id="nro-add" type="number" step="any" min="1" name="nro" class="form-control" placeholder="Ejemplo: 5" required="">
	                </div>                
	              </div><!-- /.box-body -->
	            </div><!-- /.box -->
	          </div><!--/.col (left) -->
	        </div> 
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger pull-rigth" data-dismiss="modal">Cerrar</button>
	        <button class="btn btn-success pull-left"> Registrar</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </form>
  </div><!-- /.modal-dialog -->
</div>
  
