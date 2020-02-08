@extends('layouts.main')

@section('title','Transportistas')

@section('styles')
@include('reporte_excel.excel_select2_css')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="#">Transportistas</a></li>
  <li><a href="#">Flete Pedidos</a></li>
  <li><a href="#"> Faltante Lista</a></li>
</ol>
@endsection

@section('content')

<section class="content">
	@include('transportistas.lista_faltantes.opciones')
    @include('transportistas.lista_faltantes.table')
</section>

@endsection

@section('scripts')
@include('reporte_excel.excel_select2_js')
<script>
$(document).ready(function() {
    $('#tabla-flete-faltantes').DataTable({  
        "ordering": true, 
        'responsive': false,   
        "scrollX": true,  
        "dom": 'Blfrtip',
        "buttons": [
          {
            extend: 'excelHtml5',
            title: 'Lista Faltante FLetes Transportistas',
            attr:  {
                  title: 'Excel',
                  id: 'excelButton'
              },
            text:     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
            className: 'btn btn-default',
            exportOptions:
              {
                columns:[0,1,2,3,4,5,6,7,8]
              }

           }],       
    });
});

  function confirmar()
{
  if(confirm('¿Estás seguro de eliminar el registro ?'))
    return true;
  else
    return false;
}

</script>
@endsection
