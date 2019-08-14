<td> 
  <button class='btn btn-warning' 
           onclick="editarVehiculo('<?php echo $vehiculo->id; ?>')">
    <span class='glyphicon glyphicon-edit'> </span>
  </button>

  <form style="display:inline" method="POST" action="{{ route('vehiculo.destroy', $vehiculo->id) }}">
    @csrf
    @method('DELETE')
  <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
  </form>
</td>