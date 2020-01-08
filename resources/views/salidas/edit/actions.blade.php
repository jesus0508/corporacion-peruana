<btn class="btn btn-xs btn-warning" 
  href="#modal-edit-salidas"  
  data-toggle="modal" data-target="#modal-edit-salidas"
  data-id="{{$id}}">
  <span class="glyphicon glyphicon-edit"></span>
  	&nbsp;&nbsp;Editar                       
</btn> 
<form style="display:inline" method="POST" action="{{ route('salidas.destroy',$id)}}">
  @csrf
  @method('DELETE')
  <button class="btn btn-danger btn-xs">
  	<span class="glyphicon glyphicon-trash"></span>
  </button>
</form>
