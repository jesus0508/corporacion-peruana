<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-md-6">
            <h2 class="box-title">Lista comprobación </h2>
          </div>                
        </div>          
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="tabla-reporte-comprobaciones" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th width="14%">FECHA REPORTE</th>
              <th width="1%">  asdasdas    </th>
              <th width="50%">Detalles</th>              
              <th width="15%"> Fecha</th>
              <th width="20%">Monto</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $comprobaciones as $comprobacion )
              <tr>
                <td>
                {{date('d/m/Y',strtotime($comprobacion->fecha_reporte))}}                     
                </td>
                <td>{{date('d/m/Y', strtotime($comprobacion->fecha_reporte))}}                   
                </td> 
                <td>
                  {{$comprobacion->detalle}}   
                </td>               
                <td>
                  {{$comprobacion->fecha}}                 
                </td>                
                <td>{{$comprobacion->monto}}</td>
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