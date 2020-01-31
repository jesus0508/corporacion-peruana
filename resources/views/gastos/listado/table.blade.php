<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
        <table id="tabla-gastos-listado" class="table table-bordered table-striped responsive display " style="width:100%" cellspacing="0">
          <thead>
            <tr>
             <!--  <th>#</th> -->
              <th>Fecha Egreso</th>
              <th>Fecha Reporte</th>
              <th>Grifo</th>
              <th>Categoria</th>
              <th>Subcategoria</th>
              <th>Gasto Descripcion</th>
              <th>Monto</th>              
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $egresos as $egreso )
              <tr>
                <!-- <td>{{$loop->iteration}}</td> -->
                <td>{{$egreso->fecha_egreso}}</td>
                <td>{{$egreso->fecha_reporte}}</td>
                <td>{{$egreso->grifo}}</td>                  
                <td>{{$egreso->categoria}}</td>
                <td>{{$egreso->subcategoria}}</td>
                <td>{{$egreso->concepto}}</td>
                <td>{{$egreso->monto_egreso}}</td>
                <td>  
                 <!-- Editar -->
                  <ul class="list-inline">
                    <li>
                      <btn class="btn btn-xs btn-warning btn-block" 
                      href="#modal-edit-egreso-grifo"  
                      data-toggle="modal" data-target=" #modal-edit-egreso-grifo"
                      data-id="{{$egreso->id}}">
                    <span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Editar                          
                  </btn> 
                    </li>
                    <li>
                                    <!-- Eliminar -->  
                  <form style="display:inline" method="POST" action="{{ route('egresos.destroy', $egreso) }}">
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
                <th colspan="6" style="text-align:right">Total:</th>
                <th ></th>
                <th></th>
            </tr>
        </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->