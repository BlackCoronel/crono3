<!DOCTYPE html>
<html lang="en"> <!--BIZPRO1 PLANTILLA -->
<head>
    <meta charset="UTF-8">
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- For Resposive Device -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crono3 - Cronometraje y gestión de carreras informáticas</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="56x56" href="images/fav-icon/icon.png">


    <!-- Main style sheet -->
    <link rel="stylesheet" type="text/css" href="/custom/css/style.css">
    <!-- responsive style sheet -->
    <link rel="stylesheet" type="text/css" href="/custom/css/responsive.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


    <!-- Fix Internet Explorer ______________________________________-->

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="/custom/vendor/html5shiv.js"></script>
    <script src="/custom/vendor/respond.js"></script>
    <![endif]-->

</head>

<body>
<div class="main-page-wrapper">
    <!--
    =============================================
        Theme Header
    ==============================================
    -->
    <header class="theme-main-header" style="background: #1e1e1e;">
        <div class="container">
            <a href="/" class="logo float-left tran4s"><img src="/img/logo.png" alt="Logo" width="110px;"></a>
            <!-- ========================= Theme Feature Page Menu ======================= -->
            <nav class="navbar float-right theme-main-menu one-page-menu">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        Menu
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li @if(Request::path() == "/") class="active" @endif><a href="/">
                                <i class="fas fa-home" style="margin-right: 5px;"></i>PRINCIPAL
                            </a>
                        </li>
                        <li @if(Request::path() == "pruebas") class="active" @endif>
                            <a href="/pruebas">
                                <i class="fas fa-map-marked" style="margin-right: 5px;"></i>PRUEBAS
                            </a>
                        </li>
                        <li @if(Request::path() == "inscripcion_abierta") class="active" @endif>
                            <a href="/inscripcion_abierta">
                                <i class="fas fa-user-edit" style="margin-right: 5px;"></i>INSCRIPCIÓN ABIERTA
                            </a>
                        </li>
                        <li @if(Request::path() == "resultados") class="active" @endif>
                            <a href="/resultado">
                                <i class="fas fa-poll" style="margin-right: 5px;"></i>RESULTADOS
                            </a>
                        </li>
                        <li @if(Request::path() == "consejos") class="active" @endif>
                            <a href="/consejos">
                                <i class="fas fa-book" style="margin-right: 5px;"></i> CONSEJOS
                            </a>
                        </li>
                        <li @if(Request::path() == "contacto") class="active" @endif>
                            <a href="/contacto">
                                <i class="fab fa-wpforms" style="margin-right: 5px;"></i>CONTACTO
                            </a>
                        </li>
                        @if(Auth::check())
                            @if(Auth::user()->rol == 'corredor')
                            <li class="dropdown-holder">
                                <a href="/login">
                                    <i class="fas fa-user" style="margin-right: 5px;"></i>
                                        Bienvenido, {{ auth()->user()->name }}
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="/panel_usuario">
                                             <i class="far fa-user"></i> Panel usuario
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/cerrar_sesion">
                                            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                                        </a>
                                    </li>
                                </ul>
                            </li>
                                @elseif(Auth::user()->rol == 'admin' || Auth::user()->rol == 'organizador')
                                <li class="dropdown-holder">
                                    <a href="/login">
                                        <i class="fas fa-user" style="margin-right: 5px;"></i>
                                        Bienvenido, {{ auth()->user()->name }}
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="/admin">
                                                <i class="far fa-user"></i> Administración
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/cerrar_sesion">
                                                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @elseif(Auth::user()->rol == 'club')
                                <li class="dropdown-holder">
                                    <a href="/login">
                                        <i class="fas fa-user" style="margin-right: 5px;"></i>
                                        Bienvenido, {{ auth()->user()->name }}
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="/panel_club">
                                                <i class="fas fa-running"></i> Gestionar Club
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/cerrar_sesion">
                                                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endif
                            @else
                            <li>
                                <a href="/login">
                                    <i class="fas fa-user" style="margin-right: 5px;"></i>
                                    Acceso Usuarios
                                </a>
                            </li>
                        @endif
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav> <!-- /.theme-feature-menu -->
        </div>
    </header> <!-- /.theme-main-header -->


    <!--
    =====================================================
        Theme Main SLider
    =====================================================
    -->
    @if(Request::path() == "/")
    <div id="home" class="banner">
        <div class="rev_slider_wrapper">
            <!-- START REVOLUTION SLIDER 5.0.7 auto mode -->

            <div id="main-banner-slider" class="rev_slider video-slider" data-version="5.0.7">
                <ul>
                    <!-- SLIDE1  -->
                    <li data-index="rs-280" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default"  data-title="desde 1995" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="/custom/images/home/slide-1.jpg"  alt="image" class="rev-slidebg" data-bgparallax="3" data-bgposition="center center" data-duration="20000" data-ease="Linear.easeNone" data-kenburns="on" data-no-retina="" data-offsetend="0 0" data-offsetstart="0 0" data-rotateend="0" data-rotatestart="0" data-scaleend="100" data-scalestart="140">
                        <!-- LAYERS -->

                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['-58','-58','0','-50']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"

                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:[100%];"
                             data-mask_out="x:inherit;y:inherit;"
                             data-start="1000"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"
                             style="z-index: 6; white-space: nowrap;">
                            <h1>DESDE 1995</h1>
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['-05','-05','63','0']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"

                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:[100%];"
                             data-mask_out="x:inherit;y:inherit;"
                             data-start="2000"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"
                             style="z-index: 6; white-space: nowrap;">
                            <h6>Más de 3000 pruebas cronometradas</h6>
                        </div>

                        <div class="tp-caption"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['52','185','185','105']"
                             data-transform_idle="o:1;"

                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:[100%];"
                             data-mask_out="x:inherit;y:inherit;"
                             data-start="3000"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on">
                            <a href="/pruebas" class="project-button hvr-bounce-to-right">Calendario Pruebas</a>
                        </div>
                    </li>


                    <!-- SLIDE2  -->
                    <li data-index="rs-20" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default"  data-thumb="/custom/video/drinkwinecover.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Pruebas masificadas" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="/custom/video/drinkwinecover.jpg"  alt="image" class="rev-slidebg" data-bgparallax="3" data-bgposition="center center" data-duration="20000" data-ease="Linear.easeNone" data-kenburns="on" data-no-retina="" data-offsetend="0 0" data-offsetstart="0 0" data-rotateend="0" data-rotatestart="0" data-scaleend="100" data-scalestart="140">

                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['-58','-33','-33','-100']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"

                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:[100%];"
                             data-mask_out="x:inherit;y:inherit;"
                             data-start="1000"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"
                             style="z-index: 6; white-space: nowrap;">
                            <h1>pruebas masificadas</h1>
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['-05','93','93','20']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"

                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:[100%];"
                             data-mask_out="x:inherit;y:inherit;"
                             data-start="2000"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"
                             style="z-index: 6; white-space: nowrap;">
                            <h6>Sin límite de participantes</h6>
                        </div>


                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['52','185','185','105']"
                             data-transform_idle="o:1;"

                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:[100%];"
                             data-mask_out="x:inherit;y:inherit;"
                             data-start="3000"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on">
                            <a href="/contacto" class="project-button hvr-bounce-to-right">Consúltanos</a>
                        </div>
                    </li>

                    <!-- SLIDE3  -->
                    <li data-index="rs-18" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default"  data-thumb="/custom/images/home/slide-2.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Aguas abiertas" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="/custom/images/home/slide-2.jpg"  alt="image" class="rev-slidebg" data-bgparallax="3" data-bgposition="center center" data-duration="20000" data-ease="Linear.easeNone" data-kenburns="on" data-no-retina="" data-offsetend="0 0" data-offsetstart="0 0" data-rotateend="0" data-rotatestart="0" data-scaleend="100" data-scalestart="140">
                        <!-- LAYERS -->

                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['-58','-33','-33','-100']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"

                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:[100%];"
                             data-mask_out="x:inherit;y:inherit;"
                             data-start="1000"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"
                             style="z-index: 6; white-space: nowrap;">
                            <h1>Pruebas en aguas abiertas</h1>
                        </div>
                    </li>
                    <!--SLIDE4-->
                    <li data-index="rs-19" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default"  data-thumb="/custom/images/home/slide-3.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Pruebas de obstáculos" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="/custom/images/home/slide-3.jpg"  alt="image" class="rev-slidebg" data-bgparallax="3" data-bgposition="center center" data-duration="20000" data-ease="Linear.easeNone" data-kenburns="on" data-no-retina="" data-offsetend="0 0" data-offsetstart="0 0" data-rotateend="0" data-rotatestart="0" data-scaleend="100" data-scalestart="140">
                        <!-- LAYERS -->
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['-58','-33','-33','-100']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"

                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:[100%];"
                             data-mask_out="x:inherit;y:inherit;"
                             data-start="1000"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"
                             style="z-index: 6; white-space: nowrap;">
                            <h1>Obstáculos</h1>
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['-05','-05','63','0']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"

                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:[100%];"
                             data-mask_out="x:inherit;y:inherit;"
                             data-start="2000"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"
                             style="z-index: 6; white-space: nowrap;">
                            <h6>Pruebas de obstáculos</h6>
                        </div>
                    </li>
                </ul>
            </div>
            </div>
        </div><!-- END REVOLUTION SLIDER -->
    </div> <!--  /#banner -->
    <!--
    =====================================================
        About us Section
    =====================================================
    -->
    <section id="about-us">
        <div class="container">
            <div class="theme-title">
                <h2>Sobre crono3</h2>
                <p>Somos una empresa encargada de la gestión y cronometraje de pruebas deportivas informatizadas, con más de 3000 pruebas realizadas.</p>
            </div> <!-- /.theme-title -->
        </div> <!-- /.container -->
    </section>
    <!--
    =====================================================
        Sección de las pruebas deportivas
    =====================================================
    -->
    <div id="pricing-section">
        <div class="container">
            <div class="theme-title">
                <h2>Pruebas Deportivas</h2>
            </div>
            <div class="clear-fix">
                @foreach($pruebas as $prueba)
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-bottom:10px;">
                            <div class="single-price-table hvr-float-shadow" style="padding-top: 0px;">
                                    <img src="{{ $prueba->portada }}" alt="{{ $prueba->titulo }}">
                                    <h6>{{ $prueba->titulo }}</h6>
                                    <p style="font-weight: bold; font-size: 18px;">{{ strtoupper($prueba->ciudad) }}</p>
                                    <p style="margin-top:-10px;font-weight: bold; font-size: 18px;">{{ date('d-m-Y', strtotime($prueba->fecha)) }}</p>
                                @if(date('Y-m-d') >= $prueba->plazo && $prueba->plazo != null)
                                    <a href="/pruebas/{{ $prueba->slug }}" class="tran3s p-color-bg">INSCRIBIRSE</a>
                                @elseif(date('Y-m-d') < $prueba->plazo || $prueba->plazo == null)
                                    <a href="/pruebas/{{ $prueba->slug }}" class="tran3s p-color-bg"><i class="fas fa-info-circle"></i> INFORMACIÓN</a>
                                @endif
                            </div> <!-- /.single-price-table -->
                        </div> <!-- /.col -->
                @endforeach
            </div>
        </div> <!-- /.container -->
        <div class="item text-center" style="margin-top:25px;">
            <a href="/pruebas" class="btn btn-success">ver más pruebas</a>
        </div>
    </div> <!-- /#pricing-section -->

    <!--
    =====================================================
        Partner Section
    =====================================================
    -->
    <div id="partner-section">
        <div class="container">
            <div id="partner_logo" class="owl-carousel owl-theme">
                @foreach($pruebas as $prueba)
                    <div class="item text-center">
                      <p>{{ strtoupper($prueba->titulo) }}</p>
                        <p>{{ date('d-m-Y', strtotime($prueba->fecha)) }}</p>
                    </div>
                @endforeach
            </div> <!-- End .partner_logo -->
        </div> <!-- /.container -->
    </div> <!-- /#partner-section -->
   <!-- /#AQUI VAN LA PRUEBAS DEPORTIVAS -->
@else
    @yield('content')
@endif

    <!--
    =====================================================
        Footer
    =====================================================
    -->
    <footer>
        <div class="container">
            <a href="index.html" class="logo"><img src="/img/logo.png" alt="Logo"></a>
            <p>Copyright&copy; {{ date('Y') }} CRONO3. Todos los derechos reservados</p>
        </div>
    </footer>




    <!-- =============================================
        Loading Transition
    ============================================== -->
    <!--<div id="loader-wrapper">
        <div id="preloader_1">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>-->


    <!-- Scroll Top Button -->
    <button class="scroll-top tran3s p-color-bg">
        <i class="fas fa-arrow-up" aria-hidden="true"></i>
    </button>

<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-user"></i> INICIAR SESIÓN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Usuario</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                <button type="button" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> iniciar sesión</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="inscritos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="inscritosTitulo"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-5 col-sm-4" style="margin-top:5px;">
                            <input type="search" class="form-control" id="insc" placeholder="🔎 Buscar inscrito...">
                        </div>
                        <div class="col-md-4 col-sm-4" style="margin-top:5px;">
                            <select id="filtro" class="form-control">
                                <option>- Filtrar -</option>
                                <option>nombre</option>
                                <option>dni</option>
                                <option>club</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-4 pull-right" style="margin-top:5px;">
                            <button type="button" class="btn btn-primary" id="busqueda">Buscar</button>
                        </div>
                    </div>
                <div class="table-responsive" style="margin-top: 15px;">
                    @isset($inscritos)
                        <?php $i = 1 ?>
                        <table class="table">
                            <thead>
                            <tr class="bg-primary">
                                <th scope="col">Nº</th>
                                <th scope="col">Dorsal</th>
                                <th scope="col">Corredor</th>
                                <th scope="col">Localidad</th>
                                <th scope="col">Club</th>
                                <th scope="col">Pagado</th>
                            </tr>
                            </thead>
                            <tbody id="filtrados">
                                @foreach($inscritos as $inscrito)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td></td>
                                        <td> {{ $inscrito->apellidos . ',' . $inscrito->nombre }}</td>
                                        <td> {{ $inscrito->localidad }} </td>
                                        <td> {{ $inscrito->club }} </td>
                                        @if($inscrito->pagado == 'si')
                                            <td>Si</td>
                                        @elseif($inscrito->pagado == 'no')
                                            <td>
                                                <a href="/pago/{{ $inscrito->id }}" style="font-weight: bold; color: green;">
                                                    <i class="far fa-credit-card"></i> PAGAR
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                <?php $i++ ?>
                                @endforeach
                            </tbody>
                        </table>
                    @endisset
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
            </div>
        </div>
    </div>
</div>


    <!-- Js File_________________________________ -->

    <!-- j Query -->
    <script type="text/javascript" src="/custom/vendor/jquery.2.2.3.min.js"></script>

    <!-- Script para buscar los clubes por AJAX-->
    <script>
        $(document).ready(function(){
            $('#buscar').keyup(function(){
                if($(this).val()){
                    $('#resultados').show();
                    var salida="";
                    $.ajax({
                        url: '/cargarclubes/' + $(this).val(),
                        dataType: 'json',
                        type: 'GET',
                        success: function(data){
                            console.log(data);
                            $('#resultados').html('Se han encontrado ' + (data.clubes.length)+ ' resultados');
                            for ( i = 0; i < data.clubes.length; i++){
                                salida += '<option>' + data.clubes[i].club.toUpperCase() + '</option>';
                            }
                            $('#clubes').html(salida);
                        }
                    });
                } else {
                    $('#clubes').html('<option>INDEPENDIENTE</option>');
                }
            });
        });
    </script>
    <!-- Script para cargar los inscritos -->
    <script>
        $(document).ready(function(){
            $('#cargarInscritos').click(function(){
               $('#inscritosTitulo').html('<i class="fas fa-users"></i> INSCRITOS ' + $('#carreraTitulo').text());
                console.log($('#carreraTitulo').text());
               $('#busqueda').click(function(){
                   var filtro = "";

                   if($('#filtro').val() != null && $('#filtro').val() != '- Filtrar -'){
                       filtro = $('#filtro').val();
                   } else {
                       filtro = "nombre";
                   }

                   $.ajax({
                      url: '/cargarInscritos/'+ $('#insc').val() +'/' + filtro + '/' + $('#id_prueba').val(),
                      type: 'GET',
                       success: function(data){
                          var salida = '';
                          for(i = 0; i < data.length; i++){
                              salida += '<tr>' +
                                      '<th scope="row">'+ parseInt(i+1) +'</th>' +
                                      '<th></th>'+
                                      '<th>'+ data[i].apellidos.toUpperCase() + ','+ data[i].nombre.toUpperCase()+'</th>' +
                                        '<th>'+ data[i].localidad +'</th>' +
                                  '<th>'+ data[i].club +'</th>';
                              if(data[i].pagado == 'si'){
                                  salida+= '<th>'+ data[i].pagado+'</th>';
                              }else if(data[i].pagado == 'no'){
                                  salida +='<th><a href="/pago/'+ data[i].id +'"><i class="far fa-credit-card"></i> PAGAR</a></th>';
                              }
                                  salida += '</tr>';
                          }
                          $('#filtrados').html(salida);
                       }
                   });
               });
            });
        })
    </script>

    <script>
        $(document).ready(function(){
            $('.editar').click(function(){
                $('#edt').attr('action','/editarUsrClub/' + $(this).attr('insc'))
                $.ajax({
                   url: '/usrClub/' + $(this).attr('insc'),
                   method: 'GET',
                   dataType:'json',
                   success: function(data){
                       $('#nombre').val(data[0].nombre);
                       $('#apellidos').val(data[0].apellidos);
                       $('#mail').val(data[0].email);
                       $('#dni').val(data[0].dni);
                       $('#localidad').val(data[0].localidad);
                       $('#cpostal').val(data[0].cpostal);
                       $('#fecha').val(data[0].fecha);
                       $('#licencia').val(data[0].licencia);
                       $('#ndorsal').val(data[0].nombre_dorsal);
                       $('#sexo').html("<option>Hombre</option><option>Mujer</option>");
                       $('#sexo option').each(function(){
                           if($(this).val() == data[0].sexo){
                               $(this).attr('selected','selected');
                           }
                       });
                       $('#telefono').val(data[0].telefono);
                       $('#observaciones').val(data[0].observaciones);
                       $('#domicilio').val(data[0].domicilio);
                   }
                });
                $('#editarUsr').modal();
            });

            $('.eliminar').click(function(){
               $('#eliminarUsr').modal();
               $('#elm').attr('action','/eliminarUsrClub/' + $(this).attr('insc'))
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script type="text/javascript" src="/custom/vendor/bootstrap/bootstrap.min.js"></script>

    <!-- Vendor js _________ -->

    <!-- revolution -->
    <script src="/custom/vendor/revolution/jquery.themepunch.tools.min.js"></script>
    <script src="/custom/vendor/revolution/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="/custom/vendor/revolution/revolution.extension.slideanims.min.js"></script>
    <script type="text/javascript" src="/custom/vendor/revolution/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript" src="/custom/vendor/revolution/revolution.extension.navigation.min.js"></script>
    <script type="text/javascript" src="/custom/vendor/revolution/revolution.extension.kenburn.min.js"></script>
    <script type="text/javascript" src="/custom/vendor/revolution/revolution.extension.actions.min.js"></script>
    <script type="text/javascript" src="/custom/vendor/revolution/revolution.extension.video.min.js"></script>

    <!-- Google map js -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZ8VrXgGZ3QSC-0XubNhuB2uKKCwqVaD0&callback=goMap" type="text/javascript"></script> <!-- Gmap Helper -->
    <script src="/custom/vendor/gmaps.min.js"></script>
    <!-- owl.carousel -->
    <script type="text/javascript" src="/custom/vendor/owl-carousel/owl.carousel.min.js"></script>
    <!-- mixitUp -->
    <script type="text/javascript" src="/custom/vendor/jquery.mixitup.min.js"></script>
    <!-- Progress Bar js -->
    <script type="text/javascript" src="/custom/vendor/skills-master/jquery.skills.js"></script>
    <!-- Validation -->
    <script type="text/javascript" src="/custom/vendor/contact-form/validate.js"></script>
    <script type="text/javascript" src="/custom/vendor/contact-form/jquery.form.js"></script>


    <!-- Theme js -->
    <script type="text/javascript" src="/custom/js/theme.js"></script>
    <script type="text/javascript" src="/custom/js/map-script.js"></script>

</div> <!-- /.main-page-wrapper -->
</body>
</html>