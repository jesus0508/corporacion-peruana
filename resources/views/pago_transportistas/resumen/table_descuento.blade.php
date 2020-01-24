<section class="content">
<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
            <h2 class="box-title">Lista de FALTANTES</h2>     
      </div><!-- /.box-header -->

      <div class="box-body">
        <table id="tabla-flete-faltantes2" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Descripcion</th>
              <th>Fecha Descarga</th>
              <th>GRIFO</th>
       <!--        <th>Transportista</th> -->
      <!--         <th>Planta</th> -->
              <th>Grifero</th>
              <th>Faltante gls</th>
              <th>Precio</th>
              <th>Monto Desc</th>
 
            </tr>
          </thead>
          <tbody>
            @foreach ($lista_descuento as $pedido_cliente)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$pedido_cliente->descripcion}}</td>
                <td>  
                  @if( $pedido_cliente->fecha_descarga )
                  {{date('d/m/Y', strtotime($pedido_cliente->fecha_descarga))}}
                  @else
                  No acordado
                  @endif
                </td>
                <td>{{$pedido_cliente->razon_social}}</td>
         <!--        <td>{{$pedido_cliente->nombre_transportista}}</td>   -->              
              <!--   <td>{{$pedido_cliente->planta}}</td> -->
                <td>{{$pedido_cliente->grifero}}</td>
                <td>{{$pedido_cliente->faltante}}</td>
                <td>{{$pedido_cliente->costo_galon}}</td>
                <td>
                    S/&nbsp;    {{number_format((float)
                        $pedido_cliente->faltante * $pedido_cliente->costo_galon, 2, '.', '') }}               
                          
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>    
         
                <th colspan="7">TOTAL FALTANTES</th>
                <th>S/. &nbsp; {{$desc}}</th>
            </tr>
            <tr>
              <th colspan="7"><center>PENDIENTE POR DESCONTAR ANTERIOR</center></th>
              <th> <center> S/. &nbsp;{{$transportista->descuento_pendiente}}</center></th>
            </tr>
            <tr>    
                <th colspan="3"></th> 
                <th colspan="1"><p class="pull-right">TOTAL (Subtotal fletes - faltantes - pendiente) </p></th>
                <th colspan="3"></th>
                <th align="center" style="color:red; font-weight: bold; font-size: 15px;"> &nbsp; 
                  S/. &nbsp; {{number_format((float)
                  $subtotal-$desc-$transportista->descuento_pendiente , 2, '.', '') }} 
             
                </th>
            </tr>
          </tfoot> 
        </table>
      </div>
      <div class="box-footer">

      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->
</section>