<div class="row" id="input_user">
  <!-- left column -->
  <form class="" action="{{route('grifos.balancear')}}" method="post">
    @csrf
    <div class="col-md-5">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Grifo a quitar &nbsp; <span class="fa fa-minus"></span></h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="grifo_id_sender">Elije el grifo</label>
                <select name="grifo_id_sender" id="grifo_a_quitar"
                        required="" class="form-control">                     
                  @foreach($grifos as $grifo)
                    <option value="{{$grifo->id}}">{{$grifo->razon_social}}</option>
                  @endforeach
                </select>                
              </div>
              <div class="form-group">
                <label for="stock_actual">Stock actual</label>
                <input type="text" class="form-control" placeholder="Stock Actual"
                  id="stock_actual1" readonly="">
              </div>
              <div class="form-group">
                <label for="stock_nuevo">Stock nuevo</label>
                <input type="text" class="form-control" placeholder="Nuevo Stock"
                  id="stock_nuevo1" name="grifo_sender_stock_nuevo"  readonly="">
              </div>
            </div>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (left) -->
    <div class="col-md-2">
      <br>
      <br>
      <br>   
      <div class="form-group">
        <center>  <label  for="fecha">Fecha</label> </center>       
        <input type="date" id="fecha" class="form-control" placeholder="Fecha"
         name="fecha" required=""> 
      </div>
      <div class="form-group">
        <center>  <label  for="cantidad">Cantidad galones</label> </center>       
        <input type="number" id="galones" step="any" min="1" class="form-control" placeholder="Galones"
         name="cantidad" required=""> 
      </div>
    </div>
    <div class="col-md-5">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h2 class="box-title">Grifo a dar&nbsp; <span class="fa fa-plus"></span></h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="grifo_id_receiver">Elije el grifo</label>
                <select name="grifo_id_receiver" id="grifo_a_dar"
                        required="" class="form-control">                     
                  @foreach($grifos as $grifo)
                    <option value="{{$grifo->id}}">{{$grifo->razon_social}}</option>
                  @endforeach
                </select>                
              </div>
              <div class="form-group">
                <label for="stock_actual2">Stock actual</label>
                <input type="text" class="form-control" placeholder="Stock Actual"
                  id="stock_actual2" readonly="">
              </div>
              <div class="form-group">
                <label for="stock_nuevo">Stock nuevo</label>
                <input type="text" class="form-control" placeholder="Nuevo Stock"
                  id="stock_nuevo2"  name="grifo_receiver_stock_nuevo" readonly="">
              </div>
            </div>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (left) -->  
    <div class="col-md-12">
      <div class="form-group pull-right">
        <button type="submit" class="btn btn-lg btn-success">
          <i class="fa fa-balance-scale"> </i>
          Balancear
        </button>
      </div>
    </div>
  </form>
</div> <!-- /.row-top -->


