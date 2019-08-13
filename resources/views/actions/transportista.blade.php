<td> 
  <a class="btn btn-info" href="{{ route('vehiculo.show',$transportista->id) }}">
    Gestion Cisternas
    <span class="fa fa-pencil"> </span>
  </a>
  <button class='btn btn-warning' 
           onclick="editarTransportista('<?php echo $transportista->id; ?>')">
    <span class='glyphicon glyphicon-edit'> </span>
  </button>

  <form style="display:inline" method="POST" action="{{ route('transportista.destroy', $transportista->id) }}">
    @csrf
    @method('DELETE')
  <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
  </form>
</td>