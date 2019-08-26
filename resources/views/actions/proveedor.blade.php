<td>
  <a class="btn btn-info" href="{{ route('planta.show',$proveedor->id) }}">
    <span class="fa fa-pencil"> </span> &nbsp;
    Gestion planta
    
  </a>
 
  <button class='btn btn-warning' 
           onclick="editarProveedor('<?php echo $proveedor->id; ?>')">
    <span class='glyphicon glyphicon-edit'> </span>
  </button>
  <form style="display:inline" method="POST" action="{{route('proveedores.destroy', $proveedor->id) }}">
  @csrf
  @method('DELETE')
   <button class="btn btn-danger">
     <span class="glyphicon glyphicon-trash"></span>
   </button>
  </form>        
</td>