<td> 
 <form style="display:inline" method="GET" action="{{ route('vehiculo.show',$transportista->id) }}">
    @csrf
    @method('GET')
  <button class="btn btn-info"><span class="fa fa-pen"></span>Cisternas</button>
  </form>
  <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-transportista"
                              data-id="{{$transportista->id}}" data-nombre_transportista="{{$transportista->nombre_transportista}}" data-brevete="{{$transportista->brevete}}"
                              data-celular_transportista="{{$transportista->celular_transportista}}">
    <span class="glyphicon glyphicon-edit"></span>
  </button>

  <form style="display:inline" method="POST" action="{{ route('transportista.destroy', $transportista->id) }}">
    @csrf
    @method('DELETE')
  <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
  </form>
</td>