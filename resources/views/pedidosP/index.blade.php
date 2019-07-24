@extends('layouts.main')

@section('title','Proveedores')

@section('content')
<section class="content-header">
  <h1>
    GESTIÓN PEDIDOS PROVEEDORES
    <small>Optional description</small>
  </h1>
  @include('pedidosP.create')
</section>

<section class="content">
  <h2>LISTA DE PEDIDOS</h2>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de COMPRAS A PROVEEDORES - Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="proveedores" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nro pedido</th>
                <th>Planta</th>
                <th>SCOP</th>
                <th>Fecha pedido</th>
                <th>Cantidad GLS</th>
                <th>Precio galon/u</th>
                <th>Monto</th>
                <th>Estado</th>
                 <th>Acciones</th>



              </tr>
            </thead>
            <tbody>
              @foreach ($pedidos as $pedido)
                <tr>
                  <td>{{$pedido->nro_pedido}}</td>
                  <td>{{$pedido->planta}}</td>
                  <td>{{$pedido->scop}}</td>
                  <td>{{date('d/m/Y', strtotime($pedido->fecha_despacho))}}</td>
                  <td>{{$pedido->galones}}</td>
                  <td>S/&nbsp;{{$pedido->costo_galon}}</td>
                  <td>S/&nbsp;{{number_format((float)
                    $pedido->galones*$pedido->costo_galon, 2, '.', '') }}</td>
                  @switch($pedido->estado)
                    @case(1)

                     <td> <span class="label label-danger"> SIN PROCESAR </span> </td>
                     <td>
                      <ul class="list-inline">
                        <li> 


                             <button class="btn btn-success" data-toggle="modal" data-target="   #modal-process-pedido"
                              data-id="{{$pedido->id}}"  data-costo_total="{{ number_format((float)
                                          $pedido->galones*$pedido->costo_galon, 2, '.', '')  }}"
                                data-saldo="{{ number_format((float)
                                          $pedido->galones*$pedido->costo_galon, 2, '.', '')  }}">
                              Procesar
                            </button>
                        </li>

                        <li> 
                           <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-pedido"
                              data-id="{{$pedido->id}}" data-nro_pedido="{{$pedido->nro_pedido}}" data-scop="{{$pedido->scop}}" data-planta="{{$pedido->planta}}"
                              data-fecha_despacho="{{date('d/m/Y', strtotime($pedido->fecha_despacho))}}" data-costo_galon="{{$pedido->costo_galon}}" data-galones="{{$pedido->galones}}"

                              >
                              <span class="glyphicon glyphicon-edit"></span>
                          </button>
                        </li>
                        <li> 

                          <form style="display:inline" method="POST" action="{{ route('pedidos.destroy', $pedido->id) }}">
                            @csrf
                             @method('DELETE')
                              <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                             </form>
                        </li>
                        
                      </ul>
                  

                

                   
                 </td>
                  @break


                    @case(2)
                     <td> <span class="label label-warning"> PROCESANDO </span> </td>
                     <td>  
                        <button class="btn btn-success" data-toggle="modal" data-target="#modal-process-pedido"
                              data-id="{{$pedido->id}}" data-costo_total="{{ number_format((float)
                                          $pedido->galones*$pedido->costo_galon, 2, '.', '')  }}"
                                          data-saldo="{{ $pedido->saldo}}"

                              >
                      Procesar
                    </button>
                    <button class="btn btn-warning" disabled><span class="glyphicon glyphicon-edit"></span></button>
                    <button class="btn btn-danger" disabled><span class="glyphicon glyphicon-trash"></span></button>
                    </td>



                    @break
                    @case(3)
                     <td> <span class="label label-success"> PROCESADO </span> </td>
                     <td>
                      <ul class="list-inline">
                        <li>
                                <button class="btn btn-info" data-toggle="modal"                               data-target="#modal-show-pedido" 
                                 data-id="{{$pedido->id}}" data-nro_pedido="{{$pedido->nro_pedido}}" data-scop="{{$pedido->scop}}" data-planta="{{$pedido->planta}}"
                              data-fecha_despacho="{{date('d/m/Y', strtotime($pedido->fecha_despacho))}}" data-costo_galon="{{$pedido->costo_galon}}" data-galones="{{$pedido->galones}}" data-costo_total="{{ number_format((float)
                                          $pedido->galones*$pedido->costo_galon, 2, '.', '')  }}"
                                          data-estado="PROCESADO" data-saldo="0.00" data-nro_factura="{{$pedido->nro_factura}}"

                              >Ver&nbsp;
                             <span class="glyphicon glyphicon-eye-open"></span>
                             </button>  
                        </li>
                        <li>  <button class="btn btn-default">  Print&nbsp;<span class="fa fa-print">       </span></button>
                         </li>
                    
                      </ul>
                      
                   
                    </td>


                    @break

                     @default
                         <span>Something went wrong, please try again</span>
                  @endswitch
              
                    

                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
  @include('pedidosP.process')
  @include('pedidosP.show')
  @include('pedidosP.edit')
</section>
@endsection