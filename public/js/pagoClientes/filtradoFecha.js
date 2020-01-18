$.fn.dataTable.ext.search.push(
  function (settings, data, dataIndex) {
    var $sInicio = $('#fecha_inicio');
    var $sFin = $('#fecha_fin');
    var inicio = $.datepicker.parseDate('d/m/yy', $sInicio.val());
    var fin = $.datepicker.parseDate('d/m/yy', $sFin.val());
    var dia = $.datepicker.parseDate('d/m/yy', data[2]);
    console.log(data[2]);
    if (!inicio || !dia || fin >= dia && inicio <= dia) {
      return true;
    }
    return false;
  }
);