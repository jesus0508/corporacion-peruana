<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
	  <div class="box box-success">
	    <div class="box-body">
	      <div class="row">
	        <div class="col-md-6">
			      <div class="form-group">
			        <label for="">Grifo</label>
			        <textarea  class="form-control" name="razon_social" cols="30" rows="2"
			        	readonly="">
			        	{{$grifo->razon_social}}	
			        </textarea>			        
			      </div>
			    </div>
			    <div class="col-md-2">
			    	<div class="form-group">
			        <label for="">Zona</label>
			        <input type="text" class="form-control" name="zona" value="{{$grifo->zona}}" readonly="">
			      </div>
			    </div>
	        @if($hasSerie)
	        <div class="col-md-4">
	        	<label for="">Series </label> <br/>
	        	@foreach( $grifo->series as $serie)
	        		<a class="btn btn-sm btn-danger" href="{{route('eliminar_asignacion',$serie->id)}}"><span>x</span>&nbsp;
	        			{{$serie->serie}}
	        		</a>	       	
						@endforeach
	        	
	        				       
	        </div>
	        <div class="col-md-2"></div>
	        		@else
	        		<div class="col-md-6">
	        			<div class="callout callout-danger">
			        		<h5>Ninguna serie asociada</h5>
			        		<label for="">Ninguna serie asociada</label>
			        	</div>			        	
	        		</div>
	        		@endif        		
	        	</div> <!-- end.row  --> 
	        	<div class="row">
	       <!--  		<div class="col-md-2"></div> -->
	        		<div class="col-md-8">
	    					<form action="{{route('asignacion_series')}}" method="post">
	    								@csrf
	    								<input type="hidden" name="id" value="{{$grifo->id}}">
	    								<p><b>Seleccione las series a agregar</b></p>
	    								<div class="form-group">	    									
	    									<label for="">SERIES</label>
		    							<select name="series[]" multiple="" id="serie_multi" class="form-control select2-multi">
		    								@foreach($series as $serie)
		    									<option value="{{$serie->id}}">
		    										{{$serie->serie}}
		    									</option>
		    								@endforeach
		    							</select>	   	
	    								</div>		    														
	    								<button class="btn btn-success btn-lg" type="submit">Asignar</button>
	    					</form>	  
	    				</div>
	        		<div class="col-md-2"></div>	        		
	        	</div>



	        </div>				
				</div>	<!-- 	end.box -->	
	</div><!-- end.col-md-8 -->
	<div class="col-md-8">
		
	</div>
</div>