<div class="row">
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">Planta</span>
      <select class="form-control" id="filter-planta" name="planta_id">
        @foreach( $plantas as $planta )
          <option value="{{$planta->id}}">{{$planta->planta}}</option>
        @endforeach
      </select>
    </div><!-- /input-group -->
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <button class="btn btn-success" data-toggle="modal" data-target="#modal-pagar-proveedor">
               PAGAR   &nbsp;&nbsp; <span class="fa fa-money"></span>
      </button>

    </div>
  </div>
  <div class="col-md-6">
    <div class="box box-default collapsed-box box-solid">
      <div class="box-header btn" data-widget="collapse">
          <span>Información extra</span>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
          </button>
        </div> <!-- /.box-tools -->
      </div> <!-- /.box-header -->
      <div class="box-body container" style="">
        <ul class="list-inline">
          <li> 
            <span style="background-color: #A9F5D0;  border: 1px black solid;">
            &nbsp;Monto Facturado menor &nbsp;</span>
          </li>
          <li> 
            <span style="background-color: #D8D8D8; border: 1px black solid;">
             &nbsp;Sin Factura &nbsp; </span>
          </li>
          <li> <span style="background-color: #ffcdd2; border: 1px black solid;">
            &nbsp;Monto Facturado mayor &nbsp; </span>
         </li>
        </ul>              
      </div>
            <!-- /.box-body -->
    </div>
          <!-- /.box -->
  </div>
        <!-- /.col -->

</div>