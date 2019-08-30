$(document).ready(function () {

  let $tabla_movimientos = $('#tabla-movimientos');
  let $fecha_operacion = $('#fecha_operacion');
  $tabla_movimientos.DataTable({
    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
    },
    columnDefs: [
      {
        searchable: false,
        targets: [-1]
      },
    ]
  });
  $fecha_operacion.datepicker();
});