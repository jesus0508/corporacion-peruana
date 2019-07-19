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
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de Proveedores - Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Planta</th>
                <th>Razon Social</th>
                <th>Representante</th>
                <th>Celular</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($proveedores as $proveedor)
                <tr>
                  <td>{{$proveedor->planta}}</td>
                  <td>{{$proveedor->razon_social}}</td>
                  <td>{{$proveedor->representante}}</td>
                  <td>{{$proveedor->celular}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
</section>
@endsection