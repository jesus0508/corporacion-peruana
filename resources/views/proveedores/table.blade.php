  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Lista de Proveedores - Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="tabla-proveedores" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th width="30%">Razon Social</th>
                <th width="15%">Ruc</th>
                <th width="20%">Email</th>
                <th width="30%">Acciones</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach ($proveedores as $proveedor)
                <tr>
                  <td>{{$proveedor->id}}</td>
                  <td>{{$proveedor->razon_social}}</td>
                  <td>{{$proveedor->ruc}}</td>
                  <td>{{$proveedor->email}}</td>
                  <td>
                    <input type="hidden" id="id_proveedor" value="{{$proveedor->id}}">
                    <a class="btn btn-info" href="{{ route('planta.show',$proveedor->id) }}">
                    Gestion planta
                      <span class="fa fa-pencil"> </span>
                    </a>
                    
                      <button class='btn btn-warning' 
                              onclick="editarProveedor('<?php echo $proveedor->id; ?>')">
                    <span class='glyphicon glyphicon-edit'> </span>
                    </button>
                 
                    <form style="display:inline" method="POST" action="{{ route('proveedores.destroy', $proveedor->id) }}">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger">
                        <span class="glyphicon glyphicon-trash"></span>
                      </button>
                    </form>        
                  </td>
                </tr>
              @endforeach
            </tbody>
    
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
