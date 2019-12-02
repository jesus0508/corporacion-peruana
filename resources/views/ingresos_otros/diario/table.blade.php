<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de ingresos</h2>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-reporte-ingresos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>FECHA ingreso</th>
              <th>CATEGORIA</th>              
              <th>Detalles</th>
              <th>FECHA reporte</th>
              <th>Extra Info</th>
              <th>Banco</th>
              <th>Monto</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $ingresos as $ingreso )
              <tr>
                <td>{{$ingreso->fecha_ingreso}}</td>
                <td>
                  @if($ingreso->esGrifo)
                   Ingresos Extraordinarios              
                  @else
                    {{$ingreso->categoria}} 
                  @endif                
                </td>
                <td>
                  @if($ingreso->esGrifo)
                     Ingreso Extraordinario               
                  @endif 
                
                  @if($ingreso->categoria)
                   {{$ingreso->categoria}} 
                    @if($ingreso->razon_social)
                      -&nbsp;{{$ingreso->razon_social}} 
                      @else
                        @if($ingreso->id_cat)
                          -&nbsp;Pendiente         
                        @endif                   
                    @endif
                   <!-- categoria ingreso  -->                
                  @else
                    @if($ingreso->id_cat)
                    Pendiente             <!-- pago pendiente   --> 
                    @else 
                   {{$ingreso->detalle}}   <!-- pago detalle --> 
                    @endif                  
                  @endif                
                </td>
                <td>
                    @if($ingreso->fecha_reporte)
                    {{date('d/m/Y', strtotime($ingreso->fecha_reporte))}}

                    @else
                    {{date('d/m/Y', strtotime($ingreso->fecha_ingreso))}}
                    @endif
                </td>
                <td>
                  @if($ingreso->zona)
                  {{$ingreso->zona}}                 
                  @else
                   {{$ingreso->codigo_operacion}}
                  @endif                  
                </td>
                <td>@if(!$ingreso->zona)
                   {{$ingreso->banco}}                
                  @endif
                 </td>
                <td>{{$ingreso->monto_ingreso}}</td>
                <td>
                  @if($ingreso->esIngreso)
                    <btn class="btn btn-xs btn-warning btn-block" 
                      href="#modal-edit-ingresos"  
                      data-toggle="modal" data-target=" #modal-edit-ingresos"
                      data-id="{{$ingreso->id}}">
                      <span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Editar                       
                    </btn> 
                  @endif
                  <!-- <button class="btn btn-sm btn-danger">
                    <span class="fa fa-trash"></span>&nbsp;Delete</button> -->
                </td>
              </tr>              
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="box-footer">
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->