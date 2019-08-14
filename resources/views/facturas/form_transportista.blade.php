      <form action="{{route('factura_proveedor.update',0)}}" method="post">
      @csrf
      @method('PUT')
        <div id="datos-vehiculo" class="box box-success">
          <div class="box-header with-border">
              <div class="row">
                <div class="col-md-4">
                   <h3 class="box-title"> Datos Transportist5a</h3>
                </div>
                <div class="col-md-4 pull-right">
                  <button class="btn  btn-success"> 
                    <i class="fa fa-plus-circle">&nbsp;</i>
                     ASIGNAR TRANSPORTISTA</button>
                </div>
              </div>
           <input type="hidden" id="pedido_asignar_transportista" name="id_pedido">

          </div><!-- /.box-header -->
          <div class="box-body">
            <div id="" class="row">
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="placa">Placa*</label>
                  <select class="form-control" id="placa" name="placa">
                    @foreach ( $vehiculos as $vehiculo)
                      <option value="{{$vehiculo->id}}">{{$vehiculo->placa}}</option>
                    @endforeach
                  </select>
                  
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="nombre_transportista">Nombre Transportista</label>
                  <input id="nombre_transportista" type="text" class="form-control" disabled>
                </div>
              </div>
            </div>

            <div id="" class="row">
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="modelo">Modelo cisterna</label>
                  <input id="modelo" type="text" class="form-control" disabled>
                  
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group ">
                  <label for="marca">Marca</label>
                  <input id="marca" type="text" class="form-control" disabled>
                </div>
              </div>
            </div>

          </div><!-- /.box-body -->
        </div><!-- /.box producto-->
      </form>