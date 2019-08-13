  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">LISTA DE <b>PROVEEDORES</b></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="tabla-proveedores" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
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
                  @include('actions.proveedor')
                </tr>
              @endforeach
            </tbody>
    
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
