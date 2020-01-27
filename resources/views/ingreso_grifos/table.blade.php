<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de ingresos de los Grifos</h2>
        <div class="pull-right">
            <a href="#modal-create-ingreso" data-toggle="modal" data-target="#modal-create-ingreso" class="btn btn-primary">
              <i class="fa fa-plus"></i>
              Nuevo Ingreso
            </a>
          </div>
      </div><!-- /.box-header -->
      <div class="box-body">
        @include('ingreso_grifos.opciones')
        <table id="tabla-ingreso_grifos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha Reporte</th>              
              <th>Fecha Ingreso</th>
              <th>Grifo</th>
              <th>Lectura Inicial</th>
              <th>Lectura Final</th> 
              <th>Total Galones</th>
              <th>Precio x Galon</th>
              <th>Monto</th> 
              <th>Acciones</th>             
            </tr>
          </thead>
          <tbody>
            @foreach ($ingresoGrifos as $ingresoGrifo)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$ingresoGrifo->fecha_reporte}}</td>
                <td>{{$ingresoGrifo->fecha_ingreso}}</td>
                <td>{{$ingresoGrifo->grifo->razon_social}}</td>
                <td>{{$ingresoGrifo->lectura_inicial}}</td>
                <td>{{$ingresoGrifo->lectura_final}}</td>
                <td>{{$ingresoGrifo->lectura_final-$ingresoGrifo->lectura_inicial}}</td>  
                <td>{{$ingresoGrifo->precio_galon}}</td>            
                <td>{{$ingresoGrifo->monto_ingreso}}</td>  
                <td> 
                 <!-- Editar -->
                  <ul class="list-inline">
                    <li>
                      <btn class="btn btn-xs btn-warning btn-block" 
                      href="#modal-edit-ingreso-grifo"  
                      data-toggle="modal" data-target=" #modal-edit-ingreso-grifo"
                      data-id="{{$ingresoGrifo->id}}">
                        <span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Editar                          
                      </btn> 
                    </li>
                    <li>
                    <!-- Eliminar -->  
                      <form style="display:inline" method="POST" onsubmit="return confirmarDelete()" action="{{ route('ingreso_grifos.destroy', $ingresoGrifo) }}">
                      @csrf
                      @method('DELETE')
                        <button class="btn btn-xs btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span>                         
                        </button>
                      </form> 
                    </li>
                  </ul>                            
                </td>            
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="8" style="text-align:right">TOTAL:</th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="box-footer">
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->