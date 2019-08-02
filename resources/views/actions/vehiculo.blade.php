<td> 
  <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-vehiculo"
                              data-id="{{$vehiculo->id}}" data-placa="{{$vehiculo->placa}}" data-modelo="{{$vehiculo->modelo}}"
                              data-marca="{{$vehiculo->marca}}"
                              data-proveedor_id="{{$vehiculo->proveedor_id}}">
    <span class="glyphicon glyphicon-edit"></span>
  </button>

  <form style="display:inline" method="POST" action="{{ route('vehiculo.destroy', $vehiculo->id) }}">
    @csrf
    @method('DELETE')
  <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
  </form>
</td>