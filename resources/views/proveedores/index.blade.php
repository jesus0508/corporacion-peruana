@extends('layouts.main')


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
