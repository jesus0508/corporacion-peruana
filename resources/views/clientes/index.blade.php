@extends('layouts.main')
@section('title','Clientes')
@section('content')
<section class="content-header">
  <h1>GESTIÓN CLIENTES</h1>
</section>
<section class="content">
  @include('clientes.create')
  <h2>LISTA DE CLIENTES</h2>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de clientes - Table</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="tabla-clientes" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Empresa</th>
                <th>Razon Social</th>
                <th>Tipo</th>
                <th>Ubicación</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($clientes as $cliente)
                <tr>
                  <td>{{$cliente->ruc}}</td>
                  <td>{{$cliente->razon_social}}</td>
                  <td>{{$cliente->tipo}}</td>
                  <td>{{$cliente->direccion}}</td>
                  <td>
                    <button class="btn btn-info" data-toggle="modal" data-target="#modal-show-cliente"
                              data-id="{{$cliente->id}}" data-ruc="{{$cliente->ruc}}" data-tipo="{{$cliente->tipo}}"
                              data-razonSocial="{{$cliente->razon_social}}" data-direccion="{{$cliente->direccion}}">
                      <span class="glyphicon glyphicon-eye-open"></span>
                    </button>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-cliente"
                              data-id="{{$cliente->id}}" data-ruc="{{$cliente->ruc}}" data-tipo="{{$cliente->tipo}}"
                              data-razonsocial="{{$cliente->razon_social}}" data-direccion="{{$cliente->direccion}}">
                      <span class="glyphicon glyphicon-edit"></span>
                    </button>
                    <button class="btn btn-danger">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
  @include('clientes.show')
  @include('clientes.edit')
  @include('partials.session-status')
</section>
@endsection