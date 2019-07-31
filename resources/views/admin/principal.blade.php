<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Panel de administración - CRONO3</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/adminlte/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="/adminlte/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="/adminlte/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>CRN</b>3</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>CRONO</b>3</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <i class="fas fa-bars" data-toggle="push-menu" role="button" style="float: left;background-color: transparent;background-image: none;padding: 15px 15px; color:white;">
                <span class="sr-only">Barra de navegación</span>
            </i>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/adminlte/dist/img/crono_prefil.png" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ auth()->user()->name }} {{ auth()->user()->apellidos }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="/adminlte/dist/img/crono_prefil.png" class="img-circle" alt="User Image">

                                <p>
                                    {{ auth()->user()->name }} {{ auth()->user()->apellidos }} - Administrador
                                    <small>Miembro desde {{ date('d-m-Y', strtotime(auth()->user()->created_at)) }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">
                                        <i class="fas fa-user-circle" style="margin-right: 5px;"></i>Perfil
                                    </a>
                                </div>
                                <div class="pull-right">
                                    <form action="/logout" method="POST">
                                        @csrf
                                    <button type="submit" href="#" class="btn btn-default btn-flat">
                                        <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i>Cerrar sesión
                                    </button>
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
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/adminlte/dist/img/crono_prefil.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ auth()->user()->name }} {{ auth()->user()->apellidos }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">PANEL DE CONTROL</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-newspaper" style="margin-right: 10px;"></i><span>PRUEBAS</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                         </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/nueva_prueba">
                                <i class="fas fa-calendar-plus" style="margin-right: 10px;"></i>
                                Nueva prueba
                            </a>
                        </li>
                        <li><a href="#" data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-edit" style="margin-right: 10px;"></i>
                                Editar prueba
                            </a>
                        </li>
                        <li><a href="#" data-toggle="modal" data-target="#eliminarPrueba">
                                <i class="fas fa-calendar-minus" style="margin-right: 10px;"></i>
                                Eliminar prueba
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-running" style="margin-right: 10px;"></i><span>INSCRITOS</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                         </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/nuevo_inscrito">
                                <i class="fas fa-user-plus"></i>
                                Nuevo inscrito
                            </a>
                        </li>
                        <li><a href="#" data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-user-edit"></i>
                                Editar inscrito
                            </a>
                        </li>
                        <li><a href="/eliminar_inscrito">
                                <i class="fas fa-user-times"></i>
                                Eliminar inscrito
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-users" style="margin-right: 10px;"></i><span>CLUBES</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                         </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="#" data-toggle="modal" data-target="#crearClub">
                                <i class="fas fa-user-plus" style="margin-right: 10px;"></i>
                                Nuevo Club
                            </a>
                        </li>
                        <li><a href="#" data-toggle="modal" data-target="#editarClub">
                                <i class="fas fa-user-edit" style="margin-right: 10px;"></i>
                                Editar Club
                            </a>
                        </li>
                        <li><a href="#" data-toggle="modal" data-target="#eliminarClub">
                                <i class="fas fa-user-minus" style="margin-right: 10px;"></i>
                                Eliminar Club
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="header">ORGANIZADORES</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-tools" style="margin-right: 10px;"></i><span>ORGANIZADORES</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                         </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/nuevo_inscrito">
                                <i class="fas fa-user-plus" style="margin-right: 10px;"></i>
                                Nuevo organizador
                            </a>
                        </li>
                        <li><a href="/editar_inscrito">
                                <i class="fas fa-user-edit" style="margin-right: 10px;"></i>
                                Editar organizador
                            </a>
                        </li>
                        <li><a href="/eliminar_inscrito">
                                <i class="fas fa-user-times" style="margin-right: 10px;"></i>
                                Eliminar organizador
                            </a>
                        </li>
                        <li><a href="/eliminar_inscrito">
                                <i class="fas fa-clipboard-check" style="margin-right: 10px;"></i>
                                Asignar prueba
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                PANEL DE CONTROL CRONO3
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> panel</a></li>
                <li class="active">{{ Request::path() }}</li>
            </ol>
        </section>
        @if(Request::path() == 'admin')
            <!-- Main content -->
                <section class="content">
                    <div class="container">
                        <table class="table" style="margin-top: 25px; border: black 2px solid;">
                            <thead>
                            <tr class="bg-primary">
                                <th scope="col">PRUEBA</th>
                                <th scope="col">FECHA</th>
                                <th scope="col">INSCRITOS</th>
                                <th scope="col">ABIERTA</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pruebas as $prueba)
                                <tr>
                                    <td>{{ strtoupper($prueba->titulo) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($prueba->fecha)) }}</td>
                                    <td>{{ $prueba->inscritos }}</td>
                                    <td class="text-center" style="font-size: 18px;">
                                        @if(!empty($prueba->abierta) && $prueba->abierta == 'abierta')
                                            <i class="fas fa-check" style="color:green;"></i>
                                        @else
                                            <i class="fas fa-times" style="color:red;"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
        @else
            <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
        @endif
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; {{date('Y')}} <a href="https://crono3.es">CRONO3</a>.</strong> Todos los derechos reservados.
    </footer>
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    <!--AQUI VAN TODOS LOS MODALES-->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <form action="/editar_prueba" method="POST" class="form-horizontal">
                @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="fas fa-edit"></i> Editar prueba</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"> Prueba</label>
                            <div class="col-sm-10">
                                <select name="prueba" class="form-control">
                                    <option>Seleccionar prueba...</option>
                                    @foreach($pruebas as $prueba)
                                        <option>{{ $prueba->titulo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="crearClub">
        <div class="modal-dialog">
            <form action="/crear_club" method="POST" class="form-horizontal">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title"><i class="fas fa-user-plus"></i> Crear Club</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Club</label>
                            <div class="col-sm-10">
                                <input type="text" name="club" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus-square"></i> Crear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="eliminarPrueba">
        <div class="modal-dialog">
            <form action="/eliminar_prueba" method="POST" class="form-horizontal">
                @csrf
                <div class="modal-content">
                    @if(session('delete'))
                            <div class="alert alert-success" style="margin-top: 20px;">
                                <h5 class="text-center">{{ session('delete') }}</h5>
                            </div>
                    @endif
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title"><i class="fas fa-edit"></i> Eliminar prueba</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"> Prueba</label>
                            <div class="col-sm-10">
                                <select name="prueba" class="form-control">
                                    <option>Seleccionar prueba...</option>
                                    @foreach($pruebas as $prueba)
                                        <option>{{ $prueba->titulo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Script para añadir los plazos-->
<script>
       $('#crear').click(function() {
           var cantidad = $('#cantidad').val();
           var salida = "";
           if (cantidad > 0){
               $('#esconder').hide();
               for (i = 0; i < cantidad; i++) {
                   salida += "<div class='form-group'>" +
                       "<h4>Plazo " + parseInt(i+1)+ "</h4>" +
                       "<input type='date' name='plazo[]' class='form-control'>" +
                       "<input type='date' name='fin[]' class='form-control'>" +
                       "<input type='text' name='precio[]' class='form-control' placeholder='precio'>" +
                       "</div>";
               }
               $('#plazos').html(salida + "<button type='button' class='btn btn-warning pull-right' id='cancelar'> <i class='fas fa-undo'></i> Cancelar</button>");

               $('#cancelar').click(function(){
                   $('#esconder').show();
                   $('#plazos').html("");
               });
           }
       });

       $('.remove').click(function(){
           var datos = $(this);
          $.ajax({
            url: $(this).attr('remove'),
            type: 'GET',
            success: function(){
                datos.parent().closest('div').html('');
                if($('.remove').length == 0){
                    $('#esconder_ajax').show();
                }
            }
          });
       });

       $('#editar_plazos').click(function(){
           $('.plazos').each(function(){
               $.ajax({
                    url: '/update_plazos/' +  $(this).children()[1].value + '/' + $(this).children()[2].value + '/' + $(this).children()[3].value,
                    type: 'GET',
                    success: function(){
                        console.log('plazo creado con exito');
                    },
               });
           })
       });

       $('#crear_ajax').click(function(){
           var cantidad = $('#cantidad').val();
           $('#esconder_ajax').hide();
          $.ajax({
              url: '/cargar_plazos/'+ $(this).attr('prueba') + '/' + cantidad,
              type: 'GET',
              dataType: 'json',
              success: function(data){
                  var salida = "";
                  for (i = 0; i < cantidad; i++) {
                      salida += "<div class='form-group plazos'>" +
                          "<h4>Plazo " + parseInt(i+1) +" <button type='button' remove='/delete_plazo/" + data.plazos[i].plazo + "' class='btn btn-danger pull-right remove' style='margin-top: 5px; margin-bottom: 10px;'>"+
                       "<i class='fas fa-trash'></i> eliminar plazo</button>" +
                          "</h4>" +
                          '<input type="text" name="id_prueba" value="'+ data.plazos[i].plazo +'" hidden>' +
                          "<input type='date' name='plazo[]' class='form-control'>" +
                          "<input type='text' name='precio[]' class='form-control' placeholder='precio'>" +
                          "</div>";
                  }
                  $('#plazos').html(salida);

                  $('.remove').click(function(){
                      var datos = $(this);
                      $.ajax({
                          url: $(this).attr('remove'),
                          type: 'GET',
                          success: function(){
                              datos.parent().closest('div').html('');
                              if($('.remove').length == 0){
                                  $('#esconder_ajax').show();
                              }

                              $('#editar_plazos').click(function(){
                                  console.log($('.plazos'));
                              });
                          }
                      });
                  });
              }
          });
       });




</script>
<!-- jQuery UI 1.11.4 -->
<script src="/adminlte/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="/adminlte/bower_components/raphael/raphael.min.js"></script>
<script src="/adminlte/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/adminlte/bower_components/moment/min/moment.min.js"></script>
<script src="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/adminlte/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminlte/dist/js/demo.js"></script>
<script>
    @if(session('delete'))
        $('#eliminarPrueba').modal('show');
    @endif
</script>
</body>
</html>

