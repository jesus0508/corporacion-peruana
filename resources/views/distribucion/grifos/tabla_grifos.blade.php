<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title"><b> Lista de GRIFOS</b></h2>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-pedido_clientes_dist" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>RUC</th>
              <th>Nombre GRIFO</th>
              <th>STOCK</th>
              <th>Hora Descarga</th>
              <th>Fecha Descarga</th>
              <th>Cant x asig</th> 
              <th>Acción  </th>

            </tr>
          </thead>
          <tbody>
            @foreach ($grifos as $grifo)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$grifo->ruc}}</td>
                <td>{{$grifo->razon_social}}</td>                
                <td>{{$grifo->stock}}</td>
                <form method="POST" action="{{route('asignar_gls')}}">
                @csrf 
                <td>
                  <div class="form-group @error('hora_descarga') has-error @enderror">
                    <input id="hora_descarga" style="width: 75px;" type="text" class="form-control" value="{{old("hora_descarga")}}" name="hora_descarga" placeholder="Hora">
                    @error('hora_descarga')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </td> 
                <td>
                  <div class="form-group @error('fecha_descarga') has-error @enderror">
                    <input id="fecha_descarga" style="width: 125px;" type="date" 
                    class="" value="{{old("fecha_descarga")}}" name="fecha_descarga">
                    @error('fecha_descarga')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </td> 
                </td>              
                <td>
                    <input type="hidden" name="id_grifo" value="{{$grifo->id}}">
                    <input  type="hidden" name="id_pedido_pr" value="{{$pedido->id}}">
                    <input placeholder="gls" type="number" style="width: 70px;" name="galones_x_asignar" required="" >

                </td>
                <td>
                  @if( $pedido->getGalonesStock() <= 0 )
                    <button class="btn btn-success" disabled="">Asignar gls</button>
                  @else
                    <button class="btn btn-success">Asignar gls</button>
                  @endif
                </td>
              </form>  
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->