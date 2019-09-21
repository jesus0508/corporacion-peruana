<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.nombres', 'Laravel') }} | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" nombres="viewport">
  <link rel="stylesheet" href="{{ asset('adminlte/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-green.min.css') }}">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   <!-- DATATABLES -->
  <link href="//cdn.datatables.net/responsive/2.1.1/css/dataTables.responsive.css"/>
  <!-- Responsive tables-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
  @yield('styles')
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Cor</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CORPORACION</b>Perú</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the usernombres on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()->trabajador->nombres }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->trabajador->nombres }}
                  <small>{{ Auth::user()->trabajador->created_at }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Home</a>
                </div>
                <div class="pull-right">
                  <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-default btn-flat">{{ __('Salir') }}</button>
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->trabajador->nombres }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        @if( Auth::user()->hasRole('Ventas'))
        <li id="treeview-clientes" class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Clientes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="{{route('clientes.index')}}"><i class="fa fa fa-user"></i>Gestion</a></li>
          </ul>
        </li>

        <li id="treeview-ventas" class="treeview">
          <a href="#">
            <i class="fa fa-cart-plus"></i> <span>Ventas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="{{route('pedido_clientes.create')}}"><i class="fa fa-pencil"></i>Registrar Pedido</a></li>
            <li><a href="{{route('pedido_clientes.index')}}"><i class="fa fa-list"></i>Ver Pedidos</a></li>
            <li><a href="{{route('pago_clientes.index')}}"><i class="fa fa-money"></i> Ver Pagos</a></li>
            <li><a href="{{route('movimientos.index')}}"><i class="fa fa-money"></i> Mis Movimientos</a></li>
          </ul>
        </li>
        @endif
        
        @if( Auth::user()->hasRole('Proveedores'))
        <li id="treeview-proveedores" class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Proveedores</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="{{route('proveedores.create')}}"><i class="fa fa-pencil"></i> Registro</a></li>
            <li><a href="{{route('proveedores.index')}}"><i class="fa fa-list"></i>Ver Proveedores</a></li>
          </ul>
        </li>

        <li id="treeview-compras" class="treeview">
          <a href="#">
            <i class="fa fa-building-o"></i> <span>Compras</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="{{route('pedidos.create')}}"><i class="fa fa-pencil"></i> Registro</a></li>
            <li><a href="{{route('pedidos.index')}}"><i class="fa fa-list"></i>Ver Pedidos</a></li>
            <li><a href="{{route('factura_proveedor.create')}}"><i class="fa fa-share-square-o"></i> Registrar Factura</a></li>
            <li><a href="{{route('pago_proveedors.index')}}"><i class="fa fa-money"></i>Ver Pagos</a></li>

          </ul>
        </li> 
        @endif

        <li id="treeview-transportistas" class="treeview">
          <a href="#">
            <i class="fa fa-truck"></i> <span>Transportistas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="{{route('transportista.create')}}"><i class="fa fa-pencil"></i> Registro</a></li>
            <li><a href="{{route('transportista.index')}}"><i class="fa fa-list"></i> Ver Transportistas</a></li>
            <li><a href="{{route('flete.index')}}"><i class="fa fa-bus"></i> Flete Pedidos</a></li>          
            <li><a href="{{ route( 'flete.create' ) }}"><i class="fa fa-minus-square"></i> Descuento Flete</a></li>           
            <li><a href="{{route('pago_transportistas.index')}}"><i class="fa fa-money"></i>  Pago Transportistas</a></li>                         
          </ul>
        </li>
        
        <li id="treeview-reportes" class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="{{route('pedido_clientes.index')}}"><i class="fa fa-book"></i> Reportes</a></li>
          </ul>
        </li>
        
        @if( Auth::user()->hasRole('Administrador'))
        <li id="treeview-usuarios" class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Trabajadores</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="{{route('trabajadores.index')}}"><i class="fa fa fa-user"></i>Gestion</a></li>
          </ul>
        </li>
        @endif

        @if( Auth::user()->hasRole('Grifos'))
        <li id="treeview-grifos" class="treeview">
          <a href="#">
            <i class="fa fa-building-o"></i> <span>Grifos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="{{route('grifos.index')}}"><i class="fa fa-industry"></i> Gestion</a></li>
            <li><a href="{{route('ingreso_grifos.index')}}"><i class="fa fa-sort-asc"></i> Ingresos</a></li>
          </ul>
        </li>
        @endif
        <li id="treeview-gastos" class="treeview">
          <a href="#">
            <i class="fa  fa-arrow-down"></i> <span>EGRESOS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="{{route('gastos.index')}}"><i class="fa fa-pencil"></i> 
            Agregar gasto </a></li>
            <li><a href="{{route('gastos.create')}}"><i class="fa fa-minus-square"></i> 
            Registrar gasto</a>
            </li>
<!--             <li><a href="{{route('gastos.create')}}"><i class="fa fa-credit-card"></i> 
            Salidas Cheque&Banco</a>
            </li> -->
            <li><a href="{{route('egresos.index')}}"><i class="fa fa-listS-alt">D</i> 
            Reporte Gastos Diario</a>
            </li>
            <li><a href="{{route('egresos.create')}}"><i class="fa fa-taSble">M</i> 
            Reporte Gastos Mensual</a>
            </li>
            <li><a href="{{route('egresos.reporte_gastos_anual')}}"><i class="fa fa-caSlendar">A</i> 
            Reporte Gastos Anual</a>
            </li>
            <li><a href="{{route('egresos.reporte_gastos_general')}}"><i class="fa fa-caSlendar">G</i> 
            Reporte Gastos General</a>
            </li>
          </ul>
        </li>  
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      @yield('breadcrumb')
    <!-- Main content -->
      @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{ asset('adminlte/jquery/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<!--  JS entidades -->

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>

<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.js"></script>
<script>
 $.datepicker.regional['es'] = {
  closeText: 'Cerrar',
  prevText: '< Ant',
  nextText: 'Sig >',
  currentText: 'Hoy',
  monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
  monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
  dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
  dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
  dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
  weekHeader: 'Sm',
  dateFormat: 'dd/mm/yy',
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: false,
  yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
</script>
@yield('scripts')
@include('partials.session-status')
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>
