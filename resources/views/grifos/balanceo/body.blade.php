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
                <label for="grifo_a_quitar">Elije el grifo</label>
                <select name="grifo_a_quitar" id="grifo_a_quitar"
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
                  id="stock_nuevo1"  readonly="">
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
      <br>
      <br>
      <div class="form-group">
        <center>  <label  for="galones">Cantidad galones</label> </center>       
        <input type="number" id="galones" step="any" min="1" class="form-control" placeholder="Galones"
         name="galones" required=""> 
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
                <label for="grifo_a_dar">Elije el grifo</label>
                <select name="grifo_a_dar" id="grifo_a_dar"
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
                  id="stock_nuevo2"  readonly="">
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


