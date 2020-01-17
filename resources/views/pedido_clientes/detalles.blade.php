@extends('layouts.main')

@section('title','Venta')
@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Ventas</a></li>
  <li><a href="{{route('pedido_clientes.index')}}">Ver Pedidos</a></li>
  <li><a href="#">Detalles Pedidos</a></li>
</ol>
@endsection

@section('content')
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Datos Cliente</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="cliente-detalles">Cliente</label>
                <input id="cliente-detalles" type="text" class="form-control" value="{{$pedidoCliente->cliente->razon_social}}" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="ruc-detalles">RUC</label>
                <input id="ruc-detalles" type="text" class="form-control" value="{{$pedidoCliente->cliente->ruc}}" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="numero-detalles">Numero</label>
                <input id="numero-detalles" type="text" class="form-control" value="{{$pedidoCliente->cliente->telefono}}" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="correo_cliente-detalles">Correo Cliente</label>
                <input id="correo_cliente-detalles" type="text" class="form-control" value="{{$pedidoCliente->correo_cliente}}" readonly>
              </div>
            </div>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box datos cliente -->
    </div><!--/.col (left) -->

    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">DIESEL B5 (S50) UV</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="galones-detalles">Galones</label>
                <input id="galones-detalles" type="number" class="form-control" value="{{$pedidoCliente->galones}}" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="precio_galon-detalles">Precio Galon</label>
                <input id="precio_galon-detalles" type="number" class="form-control" value="{{$pedidoCliente->precio_galon}}" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="precio_total-detalles">Total</label>
                <input id="precio_total-detalles" type="number" class="form-control" value="{{$pedidoCliente->getPrecioTotal()}}" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="saldo-detalles">Saldo</label>
                <input id="saldo-detalles" type="number" class="form-control" value="{{$pedidoCliente->saldo}}" readonly>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.box datos producto -->
    </div> <!--/.col (right) -->
    
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Datos Pedido</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
          @if(isset($pedidoCliente->facturaCliente))
            <div class="col-md-4">
              <div class="form-group">
                <label for="nro_factura-detalles">Número de Factura</label>
                <input id="nro_factura-detalles" type="text" class="form-control" value="{{$pedidoCliente->facturaCliente->nro_factura}}" readonly>
              </div>
            </div>
          @else
          <div class="col-md-4">
            <div class="form-group">
              <label for="nro_factura-detalles">Número de Factura</label>
              <input id="nro_factura-detalles" type="text" class="form-control" value="Sin factura" readonly>
            </div>
          </div>
          @endif
            <div class="col-md-4">
              <div class="form-group">
                <label for="fecha_pedido-detalles">Fecha de  registro de Pedido Cliente</label>
                <input id="fecha_pedido-detalles" type="text" class="form-control" value="{{$pedidoCliente->created_at}}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="fecha_descarga-detalles">Fecha para descarga</label>
                <input id="fecha_descarga-detalles" type="text" class="tuiker form-control" value="{{$pedidoCliente->fecha_descarga}}"
                name="fecha_descarga" disabled>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="horario_descarga-detalles">Horario para descarga</label>
                <input id="horario_descarga-detalles" type="text" class="form-control" value="{{$pedidoCliente->horario_descarga}}" readonly>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="observacion-detalles">Observacion</label>
                <textarea id="observacion-detalles" type="text" class="form-control" readonly>{{$pedidoCliente->observacion}}</textarea>
              </div>
            </div>
          </div><!-- /.first-row -->
        </div><!-- /.box-body -->
      </div><!-- /.box datos pedido -->
    </div>
  </div> <!-- /.row-top --> 
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Pedidos Proveedor Asignados a este pedido Cliente </h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table id="tabla-pedido-proveedores" class="table table-bordered table-striped responsive display nowrap" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>#</th>
                    {{--  hidden  --}} 
                    <th>Galones Pedidos</th>
                    <th>N° de Factura</th>
                    <th>Fecha Descarga</th>
                    <th>Observaciones</th>
                    {{-- end.hidden  --}} 
                    <th>SCOP</th>
                    <th>Planta</th>
                    <th>Transportista</th>
                    <th>Placa</th>
                    <th>Total galones pedido Proveedor</th>
                    <th>Galones Asignados</th>
                  </tr>
                </thead>
                  <tbody>
                  @foreach ($pedidoCliente->pedidos as $pedido)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      {{--  hidden  --}} 
                      <td>{{$pedidoCliente->galones}}</td>
                      <td>
                        @if($pedidoCliente->factura_cliente_id)
                          {{$pedidoCliente->facturaCliente->nro_factura}}
                        @else
                        Sin Factura
                        @endif
                      </td>
                      <td>{{$pedidoCliente->fecha_descarga}}</td>
                      <td>{{$pedidoCliente->observacion}}</td>
                      {{-- end.hidden  --}} 
                      <td>{{$pedido->scop}}</td>
                      <td>{{$pedido->planta->planta}}</td>
                      @if($pedido->vehiculo_id == null )
                      <td>FLETE PROPIO</td>
                      <td>FLETE PROPIO</td>
                      @else
                      <td>{{$pedido->vehiculo->transportista->nombre_transportista}}</td>
                      <td>{{$pedido->vehiculo->placa}}</td>
                      @endif
                      <td>{{$pedido->galones}}&nbsp;</td>
                      <td>{{$pedido->asignacion}}</td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <th colspan="10" style="text-align: right;">Total galones asignados</th>
                  <th></th>
                </tfoot> 
              </table>
            </div>
          </div>
        </div>
      </div><!-- /.box datos complementarios -->
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Lista de pagos del cliente</h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="tabla-pagos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                   {{--  hidden  --}} 
                <th>Galones Pedidos</th>
                <th>Precio Galón</th>
                <th>Monto TOTAL </th>
                <th>Saldo Actual Pedido</th>
                {{-- end.hidden  --}} 
                <th>Fecha Operacion</th>
                <th>Codigo Operacion</th>
                <th>Nro Factura</th>
                <th>Banco</th>
                <th>Monto Operación</th>
                <th>Monto Asignado(S/. )</th>
               {{--  <th>Saldo</th> --}}

              </tr>
            </thead>
            <tbody>
              @foreach ($pagos as $pago)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  {{--  hidden  --}} 
                  <td>{{$pedidoCliente->galones}}</td>
                  <td>{{$pedidoCliente->precio_galon}}</td>
                  <td>{{$pedidoCliente->getPrecioTotal()}}</td>
                  <td>{{$pedidoCliente->saldo}}</td>
                 {{-- end.hidden  --}} 
                  <td>{{date('d/m/Y', strtotime($pago->fecha_operacion))}}</td>
                  <td>{{$pago->codigo_operacion}}</td>
                  @if(isset($pedidoCliente->facturaCliente))
                  <td>{{$pedidoCliente->facturaCliente->nro_factura}}</td>
                  @else
                  <td>Sin factura</td>
                  @endif
                  <td>{{$pago->banco}}</td>
                  <td>S/&nbsp;{{$pago->monto_operacion}}</td>
                  <td>{{$pago->monto_asignado}}</td>
                  {{-- <td>S/&nbsp;{{$pago->saldo}}</td> --}}

                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <th colspan="10" style="text-align: right;">TOTAL MONTO PAGADO</th>
              <th></th>
            </tfoot>
          </table>
        </div>
        <div class="box-footer">
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
</section>
@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>

$(document).ready(function() {

  let $tabla_pedido_proveedores = $('#tabla-pedido-proveedores');
  let $pagos_cliente = $('#tabla-pagos');

  $tabla_pedido_proveedores.DataTable({
      "responsive": true, 
      "searching": false,
      "paging": false,
      "ordering": false,
      "info" : false,
      //"scrollX": true,
      "columnDefs": [{ "targets": [1,2,3 ],"visible": false}],
      "dom": 'Bfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Pedidos Proveedor - pedido Cliente: '+
        '{{$pedidoCliente->cliente->razon_social}}',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default button-export-factura',
        customize: function( xlsx ) {
              var sheet = xlsx.xl.worksheets['sheet1.xml'];
              let rels = xlsx.xl.worksheets['sheet1.xml'];
              var clR = $('row', sheet); 
              
              let nRows = clR.length;//6
              let total = $('c[r=F'+nRows+'] t', sheet).text();                
              $('row:last c t', sheet).text( '' );
              showExcelSubtotal(sheet,nRows,'I','Total Galones asignados:');        
            },
        'exportOptions':
        {
          columns:[1,2,3,4,5,6,7,8,9,10]
        },
        footer: true
      }],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            getSubtotal(api,10);
      }

  });
  $pagos_cliente.DataTable({
      "responsive": false, 
      "searching": false,
      "paging": false,
      "ordering": false,
      "info" : false,
      "scrollX": true,
      "dom": 'Bfrtip',
      "columnDefs": [{ "targets": [1,2,3,4],"visible": false}],
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Pagos Cliente - '+
        '{{$pedidoCliente->cliente->razon_social}}',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default button-export-factura',
        customize: function( xlsx ) {
              var sheet = xlsx.xl.worksheets['sheet1.xml'];
              let rels = xlsx.xl.worksheets['sheet1.xml'];
              var clR = $('row', sheet); 
              
              let nRows = clR.length;//6
              let total = $('c[r=F'+nRows+'] t', sheet).text();                
              $('row:last c t', sheet).text( '' );
              showExcelSubtotal(sheet,nRows,'H','Total Monto Pagado :');        
            },
        'exportOptions':
        {
          columns:[1,2,3,4,5,6,8,9,10]
        },
        footer: true
      }],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            getSubtotal(api,10);
      }

  });
});

  function showExcelSubtotal(sheet,nRows,letter,text){
    $('c[r='+letter+nRows+'] t', sheet).text(text);
    $('c[r='+letter+nRows+'] t', sheet).attr('s','37');//Negrita
  }
    function getSubtotal(api,column){
      pageTotal = api
                .column( column, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
      pageTotal = pageTotal.toFixed(2); 
      $( api.column( column ).footer() ).html(pageTotal);

  }
</script> 
@endsection