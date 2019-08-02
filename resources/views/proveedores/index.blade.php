@extends('layouts.main')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('dist/css/alt/AdminLTE-select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('content')
<section class="content-header">
  <h1>
    GESTIÓN PROVEEDORES
    <small>Optional description</small>
  </h1>
  @include('proveedores.create')
</section>

<section class="content">
  <h2>LISTA DE PROVEEDORES</h2>
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Lista de Proveedores - Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="tabla-proveedores" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="5%">Nro</th>
                <th width="20%">Razon Social</th>
                <th width="15%">Ruc</th>
                <th width="20%">Representante</th>
                <th width="40%">Acciones</th>
                
              </tr>
            </thead>
    
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->

</section>
<!-- BOTONES EN views/actions/proveedor  -->
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script type="text/javascript">
  
 $("#btn-prueba").click(function(e){

  e.preventDefault();
  alert('se abrió');


   

  });
</script>
@endsection
