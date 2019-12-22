@extends('layouts.main')

@section('title','Proveedores')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet"></link> 
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{route('pedidos.index')}}">Pedidos</a></li>
  <li><a href="{{route('pedidos.create')}}">Registro</a></li>
</ol>
@endsection

@section('content')

<section class="content-header row">
<!--   <div class="col-md-3">
    <a href="#collapseStock" class="btn btn-info" data-toggle="collapse" aria-expanded="false" aria-controls="collapseStock"> 
          <span class="fa fa-eye"> </span>&nbsp;
          Ver STOCK
    </a>

       
  </div> -->
  <div>    
  </div>
  <div class="col-md-5" id="collapseStock">
<!--     <div class="info-box">
      <span class="info-box-icon bg-green"><i class="ion ion-android-funnel"></i></span>
      <div class="info-box-content">
        <span class="info-box-text"> STOCK GENERAL</span>
        <span class="info-box-number">860</span>
      </div>
   -->
   &nbsp;&nbsp;&nbsp;&nbsp;<label for="" class="label label-default">
    Stock Total= Stock general + reserva</label>
   <h4 class=" ">&nbsp;&nbsp;&nbsp;&nbsp;<b>STOCK TOTAL: </b>
    <span class="label label-default">
      @if( $stock!=null ) 
        {{$stock->getTotal()}}
      @else 
      0
      @endif
    </span> &nbsp;galones</h4>
    </div>
      <div class="col-md-7">
        <div class="box box-default collapsed-box box-solid">
          <div class="box-header btn" data-widget="collapse">
              <span>Información extra</span>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
              </button>
            </div> <!-- /.box-tools -->
          </div> <!-- /.box-header -->
          <div class="box-body container" style="">
            <ul class="list-inline">
              <li> 
                <span style="background-color: #A9F5D0;  border: 1px black solid;">
                &nbsp;Monto Facturado menor &nbsp;</span>
              </li>
              <li> 
                <span style="background-color: #D8D8D8; border: 1px black solid;">
                 &nbsp;Sin Factura &nbsp; </span>
              </li>
              <li> <span style="background-color: #ffcdd2; border: 1px black solid;">
                &nbsp;Monto Facturado mayor &nbsp; </span>
             </li>
            </ul>              
          </div>
                <!-- /.box-body -->
        </div>
              <!-- /.box -->
      </div>
</section>

<section class="content">

    @include('pedidosP.table')
    <!-- mODAL-->
    @include('pedidosP.edit')
    @include('pago_proveedores.modal')
    <!-- End mODAL-->
</section>


@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{ asset('js/pedidos.js') }}"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function(){
  function hasFactura(id){
      //console.log(id);
  return 
    $.ajax({
      type: 'GET',
      url:`./show_pedido_completo/${id}`,
      dataType : 'json'      
    }); 
    }

  $("#modal-pagar-proveedor").on("show.bs.modal", function(event) {      
    $.get('pago_proveedors/create', function( data ) {
        var html = "";
       // console.log(data);
        data.forEach(function(val) {
          var keys = Object.keys(val);
          var prueba = 'futuro valor para saber si hay deuda con el proveedor';
         // console.log(val);
        //  console.log(band);
          if( val != null ){ 
            html +='<div class="row">';
            html +=  '<div class="col-md-2"></div>';
            html +=  '<div class="col-md-8">';
            if ( prueba != null) {
                          html +=    '<a href="pago_proveedors/'+val['id']+'" class="btn  btn-block btn-lg btn-success">'+val['razon_social'];
            html +=    '</a> ';
            }
            html +=  '</div>';
            html +=  ' <div class="col-md-2"></div>';
            html +='</div>';
            html +='</br>';         
            $(".show-proveedores").html(html);
          }
        });     
    });   
  });


});

function validateDates() {
  let $tabla_proveedores = $('#proveedores');
 
  $('#fecha_inicio').datepicker({
    numberOfMonths: 2,
    onSelect: function (selected) {
      $('#fecha_fin').datepicker('option', 'minDate', selected)
    }
  });
  $('#fecha_fin').datepicker({
    numberOfMonths: 2,
    onSelect: function (selected) {
      $('#fecha_inicio').datepicker('option', 'maxDate', selected)
    }
  });

  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var sInicio = $('#fecha_inicio').val();
      var sFin = $('#fecha_fin').val();
      var inicio = $.datepicker.parseDate('d/m/yy', sInicio);
      var fin = $.datepicker.parseDate('d/m/yy', sFin);
     // console.log(data[7]);
      if (data[7]=='') {
      var dia = "06/06/1966";//fecha random que nunca hará match 
      }else{
        var dia = $.datepicker.parseDate('d/m/yy', data[7]);
      }
      
      if (!inicio || !dia || fin >= dia && inicio <= dia) {
        return true;
      }
      return false;
    }
  );

  $('#filtrar-fecha').on('click', function () {
    $tabla_proveedores.DataTable().draw();
  });

  $('#clear-fecha').on('click', function () {
    $('#fecha_inicio').val("");
    $('#fecha_fin').val("");
    $tabla_proveedores.DataTable().draw();
  });

}

$(document).ready(function() {
  validateDates();
  $('#proveedores').DataTable({
      'language': {
               'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
      "responsive": true,
            "dom": 'Blfrtip',
      "buttons": [
        {
          extend: 'excelHtml5',
          title: 'Pedidos Proveedor',
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
         }
        ],
     // "ordering": false,
        columnDefs: [
          { orderable: false, targets: -1},
          { searchable: false, targets: [-1]},
          { responsivePriority: 2, targets: [0,2] },         
          { responsivePriority: 10002, targets: [3,4,5] },
          { responsivePriority: 1, targets: [1,-1,-2] }
        ],
         "aaSorting": [],

      "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        //inicializar 
        $('td:eq(8)', nRow).html( 'S./ '+aData[8] );   
        $('td:eq(6)', nRow).html( 'S./ '+aData[6] ); 
        if(aData[4] > 0){
          $('td:eq(4)', nRow).html( 'S./ '+aData[4] );
        } 
        if( aData[6] === '0.00' ){
          $('td', nRow).css('background-color', '#D8D8D8');//GRIS
          $('td:eq(6)', nRow).html( 'Sin factura' );
          $('td:eq(8)', nRow).html( 'Sin factura' );
          }else if( parseFloat(aData[6]) < parseFloat(aData[5])  ){
            $('td', nRow).css('background-color', '#A9F5D0');//verde
            $('td:eq(6)', nRow).html( 'S./ '+aData[6] );
          }else if(parseFloat(aData[6]) > parseFloat(aData[5])  ){
            $('td', nRow).css('background-color', '#ffcdd2');//ROJO
            $('td:eq(6)', nRow).html( 'S./ '+aData[6] );            
            $('td:eq(6)', nRow).addClass("label-danger");
        }         
      }
  });
});
</script>
@endsection