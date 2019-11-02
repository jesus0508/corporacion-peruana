  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">LISTA DE <b>PROVEEDORES</b></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="tabla-proveedores-reporte-deuda" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th width="35%">Razon Social</th>
                <th width="20%">Deuda Total </th>
                <th width="20%"> Linea de Crédito</th>
                <th width="20%"> Disponible </th>
                <th width="15%">Sobregiro </th>        
              </tr>
            </thead>
            <tbody>
              @foreach ($proveedores as $proveedor)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$proveedor->razon_social}}</td>
                  <td>{{$proveedor->calc*100/100}} </td>
                  <td>S/. {{$proveedor->linea_credito}}</td>                  
                  <td>S/. {{$proveedor->linea_credito-$proveedor->calc*100/100}}</td>
                  <td>S/. {{$proveedor->sobregiro}}</td>                  
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                  <th colspan="2">Total Deuda:</th>
                  <th></th>
                  <th colspan="3"></th>
              </tr>
            </tfoot>    
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
