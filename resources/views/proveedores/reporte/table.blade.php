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
                <th width="35%">Razon Social</th>
                <th width="15%">Deuda Total </th>
                <th width="15%"> Linea de Crédito</th>
                <th width="15%"> Disponible </th>
                <th width="15%">Sobregiro? </th>                
              </tr>
            </thead>
            <tbody>
              @foreach ($proveedores as $proveedor)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$proveedor->razon_social}}</td>
                  <td><label class="label label-default" style="font-size:13px;">S/ &nbsp;{{$proveedor->calc*100/100}} </label></td>
                  <td>S/. {{$proveedor->linea_credito}}</td>                  
                  <td>S/. {{$proveedor->linea_credito-$proveedor->calc*100/100}}</td>
                  <td>S/. 450000 ?</td>                  
                </tr>
              @endforeach
            </tbody>
    
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
