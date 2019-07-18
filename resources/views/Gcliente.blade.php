@extends('plantilla')


@section('content')
  <section class="content-header">
      <h1>
      	GESTIÓN CLIENTES
        <small>Optional description</small>
      </h1>
   
    </section>


    <section class="content">
  <div class="row"> 
	

        	<div class="col-md-12">
        		
				
                    <button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-plus-square-o"> </i>
                    					Registrar nuevo cliente </button>
              
				<p> </br></p>
        	</div>

 	



</div>   <!-- /.row -->
<div class="row">
	
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Datos principales</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Empresa</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Razon Social</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
              
          
                  </div><!-- /.box-body -->
           
                </form>
              </div><!-- /.box -->
      
        	</div><!--/.col (left) -->

 			<div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Datos secundarios</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Representante</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Ubicación</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
              
          
                  </div><!-- /.box-body -->
           
                </form>
              </div><!-- /.box -->
      
        	</div><!--/.col (right) -->
</div>




   <h2>
    LISTA DE CLIENTES
      </h2>


    
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de clientes - Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Empresa</th>
                  <th>Razon Social</th>
                  <th>Representante</th>
                  <th>Ubiación</th>
                </tr>
                </thead>
                <tbody>


                <tr>
                  <td>Trident</td>
                  <td>Internet
                    Explorer 4.0
                  </td>
                  <td>Win 95+</td>
                  <td> 4</td>
                </tr>
                 <tr>
                  <td>Trident</td>
                  <td>Internet
                    Explorer 4.0
                  </td>
                  <td>Win 95+</td>
                  <td> 4</td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>Internet
                    Explorer 4.0
                  </td>
                  <td>Win 95+</td>
                  <td> 4</td>
                </tr>



           		 </tbody>
           	</table>
           </div>
          </div> <!-- end box -->
       </div>
    </div><!-- end row -->




</section>




@endsection