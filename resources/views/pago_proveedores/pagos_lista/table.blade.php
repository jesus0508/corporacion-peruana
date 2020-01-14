<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header">      
          <div class="row">
            <div class="col-md-6">
              <h3 class="box-title pull-left">Lista de PAGOS A 
                <a href="{{route('pedidos.index')}}">Pedidos</a> &nbsp; &nbsp; &nbsp;
              </h3>  
            </div>
            <div class=" col-md-6 ">
              <div class="pull-right">
                <a href="{{route('pedidos.index')}}"> 
                  <button class="btn bg-olive">
                  <span class="fa fa-list"></span> &nbsp; IR PEDIDOS
                  </button>
                </a>                            
              </div>
            </div>    
          </div>   
        </div>
        <!-- /.box-header -s-->
        <div class="box-body">

          <table id="tabla-pagos_lista" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>Proveedor  Pagado</th>                
                <th>Fecha de Operacion</th>
                <th>Fecha Egreso</th>                                
                <th>Número de Operacion</th>
                <th>Monto de Operacion</th>
                <th>Banco</th> 
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pagos as $pago)
                <tr>
                  <td>{{$pago->razon_social}}</td>                  
                  <td>{{date('d/m/Y', strtotime($pago->fecha_operacion))}}</td> 
                  <td>{{date('d/m/Y', strtotime($pago->fecha_reporte))}}</td>
                  <td>{{$pago->codigo_operacion}}</td>
                  <td>{{$pago->monto_operacion}}</td>
                  <td>{{$pago->banco}}</td>
                  <td><a href="{{ route('pago_proveedors.resumen_pago', $pago->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>&nbsp;&nbsp;Detalles</a>
                    <form style="display:inline" method="POST"  onsubmit="return confirmar()" action="{{route('pago_proveedors.reverse', $pago->id)}}">
                      @csrf
                      @method('DELETE')
                      <button class="btn bg-maroon btn-xs"><span class="fa fa-undo"></span>
                      Deshacer
                      </button>
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
</section>
