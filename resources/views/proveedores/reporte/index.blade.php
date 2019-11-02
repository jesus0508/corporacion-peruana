@extends('layouts.main')

@section('title','Proveedores')

@section('styles')
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet"></link>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ route('proveedores.index') }}">Proveedores</a></li>
  <li><a href="{{ route('proveedores.create') }}">Registro</a></li>
</ol>
@endsection

@section('content')
<section class="content-header">
      <a href="{{ route('proveedores.create') }}">
      <button class="btn bg-olive pull-right">
      <span class="fa fa-plus"></span> &nbsp; NUEVO PROVEEDOR&nbsp;|&nbsp;PLANTA 
      </button>
    </a> 
    <p><br></p>
</section>
<section class="content">  
  @include('proveedores.reporte.table')
</section>

@endsection
@section('scripts')
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

<script>
	$(document).ready(function() {
  $('#tabla-proveedores-reporte-deuda').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "responsive": true,
      "dom": 'Bfrtip',
      "buttons": [
      {
        'extend': 'excelHtml5',
        'title': 'Deuda proveedores Lista',
        'attr':  {
          title: 'Excel',
          id: 'excelButton'
        },
        'text':     '<span class="fa fa-file-excel-o"></span>&nbsp; Exportar Excel',
        'className': 'btn btn-default',
        customize: function( xlsx ) {
              var sheet = xlsx.xl.worksheets['sheet1.xml'];
              let rels = xlsx.xl.worksheets['sheet1.xml'];
              var clR = $('row', sheet); 
              
              let nRows = clR.length;//6
              let total = $('c[r=F'+nRows+'] t', sheet).text();                
              $('row:last c t', sheet).text( '' );
              $('c[r=A'+nRows+'] t', sheet).text('TOTAL Deuda:' );
              $('c[r=A'+nRows+'] t', sheet).attr('s','37');
              $('c[r=B'+nRows+'] t', sheet).text( total );
              $('c[r=B'+nRows+'] t', sheet).attr('s','37');             
            },
        'exportOptions':
        {
          columns:[1,2,3,4,5]
        },
        footer: true
      }], 

      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                      return Number(a) + Number(b);
                }, 0 );
            pageTotal = pageTotal.toFixed(2); 
            // Update footer
            $( api.column( 2 ).footer() ).html(
                pageTotal
                // +' (S/.'+ total +' total)'
            );
      }
  });
});
</script>
@endsection

