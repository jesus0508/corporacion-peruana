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
          <table id="proveedores" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Razon Social</th>
                <th>Dirección</th>
                <th>Representante</th>
                <th>Celular</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($proveedores as $proveedor)
                <tr>
                 
                  <td>{{$proveedor->razon_social}}</td>
                  <td>{{$proveedor->direccion}}</td>
                  <td>{{$proveedor->representante}}</td>
                  <td>{{$proveedor->celular}}</td>
                  <td>  

                    <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-proveedor"
                              data-id="{{$proveedor->id}}" data-representante="{{$proveedor->representante}}" data-celular="{{$proveedor->celular}}"
                              data-razon_social="{{$proveedor->razon_social}}" data-direccion="{{$proveedor->direccion}}">
                      <span class="glyphicon glyphicon-edit"></span>
                    </button>


                     <form style="display:inline" method="POST" action="{{ route('proveedores.destroy', $proveedor->id) }}">
                            @csrf
                             @method('DELETE')
                              <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                      </form>
                    


                  </td>


                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> <!-- end box -->
    </div>
  </div><!-- end row -->
    @include('proveedores.edit')
    @include('partials.session-status') 
</section>

@endsection
