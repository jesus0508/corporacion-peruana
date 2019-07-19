@extends('layouts.main')


@section('content')
<section class="content-header">
  <h1>
    GESTIÓN CLIENTES
    <small>Optional description</small>
  </h1>
  @include('clientes.create')
</section>

<section class="content">
  <h2>LISTA DE CLIENTES</h2>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de clientes - Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Empresa</th>
                <th>Razon Social</th>
                <th>Tipo</th>
                <th>Ubicación</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($clientes as $cliente)
                <tr>
                  <td>{{$cliente->ruc}}</td>
                  <td>{{$cliente->razon_social}}</td>
                  <td>{{$cliente->tipo}}</td>
                  <td>{{$cliente->direccion}}</td>
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