<div class="row">
	<div class="col-md-12">

		<div class="row">
			@foreach($series as $serie)
			<div class="col-md-4">
	      <div class="box box-success">
	        <div class="box-body">
	        	<div class="row">
	        		<div class="col-md-5">
	        		  <form action="{{ route('series.update',0) }}" method="POST">
			          @csrf
			          @method('PUT')
          				<input type="hidden" name="id" value="{{$serie->id}}">
			        		<div class="form-group">
			        			<label for="">Serie:</label>
			        			<input type="text" class="form-control" name="serie" value="{{$serie->serie}}" readonly="">
			        		</div>
			        		<div class="form-group">
			        			<label for="">Número de serie</label>
			        			<input type="number" class="form-control" name="nro" value="{{$serie->nro}}">
			        		</div>			        		
			        			<button type="submit" class="btn pull-left btn-primary">
					            <i class="fa fa-save"> </i>
					               
					          </button>	   
        				</form>	  
        				@if(!$serie->grifo_id)
								<form style="display:inline" method="POST" 
						    	action="{{ route('series.destroy', $serie->id) }}">
				          @csrf
				          @method('DELETE')
				          <button class="btn btn-danger pull-right">
				            <span class="glyphicon glyphicon-trash"></span>
				          </button>
			        	</form>
        				@endif      				
						    
	        		</div>
	        		@if($serie->grifo_id)
	        		<div class="col-md-7">
	        			<div class="callout callout-success">
			        		<h5>GRIFO:</h5>
			        		<label for="">{{$serie->grifo->razon_social}}</label>			        		
			        	</div>
			        	<div class="pull-right">
			        		<a href="{{route('series.show', $serie->grifo->id)}}" class="btn bg-purple"       >
                    <span class="fa fa-chain"></span>&nbsp;Gestión Grifo - Serie
                  </a>  			        		
			        	</div>
	        		</div>
	        		@else
	        		<div class="col-md-7">
	        			<div class="callout callout-danger">
			        		<p>Ningun grifo asociado</p>
			        	<!-- 	<label for="">Ningun grifo asociado</label> -->

			        	</div>
	        		</div>
	        		@endif        		
	        	</div> <!-- end.row  --> 	
	        </div>				
				</div>	<!-- 	end.box -->	
			</div><!-- end.col-md-6 -->
		@endforeach
		</div>
	</div>
</div>