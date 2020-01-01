$(document).ready(function () {

  let $tabla_movimientos = $('#tabla-movimientos');
  let $fecha_operacion = $('#fecha_operacion');
  let $fecha_reporte = $('#fecha_reporte');
  
  $tabla_movimientos.DataTable({
    columnDefs: [
      {
        searchable: false,
        targets: [-1]
      },
    ]
  });
  $fecha_operacion.datepicker();
  $fecha_reporte.datepicker();
});