<button class="btn btn-warning btn-sm" 
	data-toggle="modal" data-target="#modal-edit-deposito"
  data-id="{{$id}}">
  <span class="glyphicon glyphicon-edit"></span>
</button>
<form style="display:inline" method="POST" action="{{ route('depositos.destroy', $id) }}">
  @csrf
  @method('DELETE')
  <button class="btn btn-danger btn-sm">
  	<span class="glyphicon glyphicon-trash"></span>
  </button>
</form>
