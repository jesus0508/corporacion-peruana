<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
        <table id="tabla-gastos-general" class="table table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Año</th>
              <th>Monto</th>
            </tr>
          </thead>
          <tbody>            
            @foreach( $egresos as $egreso )
              <tr>
                <td>{{ $loop->iteration}}</td>  
                <td>{{ $egreso->year}}</td>              
                <td>{{ $egreso->subtotal}}</td>
              </tr>            
            @endforeach    
          </tbody>
            <tfoot>
            <tr>
                <th colspan="2" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
        </table>
      </div>
    </div> <!-- end box -->
  </div>
</div><!-- end row -->