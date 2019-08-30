<section class="content">
<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
            <h2 class="box-title">Lista de Pedidos - Flete</h2>
            @include('transportistas.flete.opciones')
      
      </div><!-- /.box-header -->

      <div class="box-body">
        <table id="tabla-flete-pedidos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>Fecha Descarga</th>
              <th>GRIFO</th>
              <th>Gls</th>
              <th>Horario desc</th>
              <th>SCOP</th>
              <th>Transportista</th>
              <th>Planta</th>
            <!--   <th>Importante</th>
 -->              <th>Estado</th>
              <th>Accion</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pedidos as $pedido_cliente)
              <tr>
                <td>{{date('d/m/Y', strtotime($pedido_cliente->fecha_descarga))}}</td>
                <td>{{$pedido_cliente->razon_social}}</td>
                <td>{{$pedido_cliente->galones}}</td>
                <td>{{$pedido_cliente->horario_descarga}}</td>
                <td>{{$pedido_cliente->scop}}</td>
                <td>{{$pedido_cliente->nombre_transportista}}</td>
                <td>{{$pedido_cliente->planta}}</td>
               <!--  <td>{{$pedido_cliente->observacion}}</td> -->
                  @includeWhen($pedido_cliente->estado_flete == 1, 'actions.flete.acciones_confirmado') 
                  @includeWhen($pedido_cliente->estado_flete == 2, 'actions.flete.acciones_completado')
                  @includeWhen($pedido_cliente->estado_flete == 3, 'actions.flete.acciones_pagado') 
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
</section>