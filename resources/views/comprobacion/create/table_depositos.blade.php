<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h2 class="box-title">Lista de egresos - DEPÓSITOS</h2>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-reporte-depositos" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>FECHA depósito</th>
              <th>CATEGORIA</th>
              <th>N° de Cuenta</th>                 
              <th>Banco</th>
              <th>Detalle</th>
              <th>N° de Operación</th>
              <th>Monto</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $depositos as $deposito )
              <tr>
                <td>@if($deposito->fecha_reporte)
                    {{date('d/m/Y', strtotime($deposito->fecha_reporte))}}                     
                    @else
                    {{date('d/m/Y', strtotime($deposito->fecha_deposito))}}
                    @endif                
                </td>
                <td>@if($deposito->abreviacion)
                    @php
                      $partes = explode(" ", $deposito->nro_cuenta);
                    @endphp               
                    DEPOSITO {{$partes[0]}}                      
                    @else
                    VENTA CLIENTE DIRECTO                   
                    @endif                  
                </td>
                <td>
                  @if($deposito->nro_cuenta)    
                    @php
                      $partes = explode(" ", $deposito->nro_cuenta);
                    @endphp               
                    {{$partes[1]  }}    
                  @else
                    {{$deposito->banco}}
                  @endif 
                </td>
                <td>{{$deposito->banco}}</td>
                <td>                 
                  {{$deposito->detalle}}                              
                </td>
                <td>
                  {{$deposito->codigo_operacion}}                 
                </td>                
                <td>{{$deposito->monto}}</td>
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