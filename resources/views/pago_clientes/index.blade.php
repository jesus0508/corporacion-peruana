@extends('layouts.main')
@section('title','Pagos')
@section('styles')
@endsection

@section('content')
<section class="content-header">
  <h1>PAGOS DEL CLIENTES</h1>
  @include('pagos.show')
</section>
@endsection

@section('scripts')    
@endsection