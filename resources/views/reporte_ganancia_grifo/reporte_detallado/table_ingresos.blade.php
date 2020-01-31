<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header">
        <div class="row">
          <div class="col-md-6">
           <button class="btn btn-success  pull-right" id="getNeto">
                  Obtener Neto                  
            </button>     
          </div>  
          <div class="col-md-6">
              
            <div class="form-inline">
              <label for=>TOTAL NETO</label>
              <input type="text" id="total-neto"  value="0" class="form-control" readonly="">
            </div>   
          </div>  
        </div>            
      </div>
      <div class="box-body">
        <table id="tabla-ingreso-grifo" class="table mytables table-bordered table-striped responsive display nowrap" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>Fecha Reporte</th>
              <th>Fecha Ingreso</th>
              <th>Grifo</th>
              <th>Descripción</th>
              <th>Monto (S/.)</th>
            </tr>
          </thead>
            <tfoot>
              <tr>
                  <th colspan="4" style="text-align:right">TOTAL INGRESOS:</th>
                  <th id="subtotal-ingresos"></th>
              </tr>
            </tfoot>
        </table>
