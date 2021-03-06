<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Lista de Grifos</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-grifos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>RUC</th>
              <th>Razón Social</th>
              <th>Teléfono</th>
              <th>Administrador</th>
              <th>Stock</th>
              <!-- <th>Distrito</th> -->
              <th>Zona</th>
              <th>Series</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($grifos as $grifo)
              <tr>
                <td>{{$grifo->ruc}}</td>
                <td>{{$grifo->razon_social}}</td>
                <td>{{$grifo->telefono}}</td>
                <td>{{$grifo->administrador}}</td>
                <td>{{$grifo->stock}}</td>
                <!-- <td>{{$grifo->distrito}}</td> -->
                <td>{{$grifo->zona}}</td>
                <td>
                  @if(count($grifo->series)>0)
                    <label for="series"class="label label-default">                    
                      Serie:&nbsp;                  
                      @foreach($grifo->series as $serie)
                        {{$serie->nro}}&nbsp;
                      @endforeach
                    </label>
                  @else
                    <label for="series" class="label label-default">
                      No tiene  
                    </label>                  
                  @endif                
                </td>
                <td>
                  <a href="{{route('series.show', $grifo->id)}}" class="btn bg-purple"       >
                    <span class="fa fa-chain"></span>&nbsp;Series
                  </a>             

                  <button class="btn btn-info" data-toggle="modal" data-target="#modal-show-grifo"
                            data-id="{{$grifo->id}}">
                    <span class="glyphicon glyphicon-eye-open"></span>
                  </button>                  
                  <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-grifo"
                            data-id="{{$grifo->id}}">
                    <span class="glyphicon glyphicon-edit"></span>
                  </button>
                  <form style="display:inline" method="POST" onsubmit="return confirmar()" action="{{ route('grifos.destroy', $grifo->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></button>
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