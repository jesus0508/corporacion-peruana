<div class="row">
  <div class="col-md-5">
    <div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <p> 
        <label for="" class="label label-default">Solo mostrará las facturaciones grifo que tienen cancelaciones.</label> 
      </p>
    </div>
  </div>
  <div class="col-md-7">
    <div class="pull-right">
      <a class="btn btn-primary" href="{{route('grifos.index')}}">
        <i class="fa fa-building-o">&nbsp;</i>Gestion
      </a>
      <a class="btn btn-success" href="{{route('factura_grifos.create')}}">
        <i class="fa fa-plus">&nbsp;</i>Registrar Venta Facturación Grifo
      </a>
      <a class="btn btn-success" href="{{route('cancelacion.create')}}">
            <i class="fa fa-plus"></i>&nbsp;Registrar Cancelación
      </a>      
    </div>    
  </div>
</div>
<div class="row">
  <p></p> 
</div>