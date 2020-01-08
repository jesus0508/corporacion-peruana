<btn class="btn btn-xs btn-warning" 
  href="#modal-edit-ingresos"  
  data-toggle="modal" data-target="#modal-edit-ingresos"
  data-id="{{$id}}">
  <span class="glyphicon glyphicon-edit"></span>
  	&nbsp;&nbsp;Editar                       
</btn> 
<form style="display:inline" method="POST" action="{{ route('ingresos_otros.destroy',$id)}}">
  @csrf
  @method('DELETE')
  <button class="btn btn-danger btn-xs">
  	<span class="glyphicon glyphicon-trash"></span>
  </button>
</form>
