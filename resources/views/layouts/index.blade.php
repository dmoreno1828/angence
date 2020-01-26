
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Agencia - @yield('title')</title>
        <meta content="App Sorteos" name="description" />
        <meta content="Duglas Moreno" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        @section('css')
        @include('layouts.partials.style')
        @show
        

    </head> 


    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <div class="header-bg">
            <!-- Navigation Bar-->
            <header id="topnav">
                <div class="topbar-main">
                    <div class="container-fluid">

                        <!-- Logo-->
                        <div class="d-block d-lg-none mr-5">
                            
                            <a href="#" class="logo">
                                <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="28" class="logo-small"> 
                            </a>

                        </div>
                        <!-- End Logo-->

                        <div class="menu-extras topbar-custom navbar p-0">

                            <ul class="list-inline flags-dropdown d-none d-lg-block mb-0">
                                <li class="list-inline-item text-white-50 mr-3">
                                        <div class="date">
                                                <span id="weekDay" class="weekDay"></span>, 
                                                <span id="day" class="day"></span> de
                                                <span id="month" class="month"></span> del
                                                <span id="year" class="year"></span>
                                            </div>
                                            <div class="clock">
                                                <span id="hours" class="hours"></span> :
                                                <span id="minutes" class="minutes"></span> :
                                                <span id="seconds" class="seconds"></span>
                                            </div>
                                </li>
                            </ul> 
                         

                            <ul class="list-inline ml-auto mb-0">
                                
                                <!-- notification-->


                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                        <i class="mdi mdi-bell-outline noti-icon"></i>
                                        <span class="badge badge-info badge-pill noti-icon-badge">3</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-arrow dropdown-menu-lg">
                                        <!-- item-->
                                        <div class="dropdown-item noti-title">
                                            <h5>Notification (3)</h5>
                                        </div>

                                        <div class="slimscroll-noti">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                                <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                                <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                            </a>

                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i></div>
                                                <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>
                                            </a>

                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                <div class="notify-icon bg-info"><i class="mdi mdi-filter-outline"></i></div>
                                                <p class="notify-details"><b>Your item is shipped</b><span class="text-muted">It is a long established fact that a reader will</span></p>
                                            </a>

                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                <div class="notify-icon bg-success"><i class="mdi mdi-message-text-outline"></i></div>
                                                <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>
                                            </a>

                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                <div class="notify-icon bg-warning"><i class="mdi mdi-cart-outline"></i></div>
                                                <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                            </a>

                                        </div>
                                        

                                        <!-- All-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-all">
                                            View All
                                        </a>

                                    </div>
                                </li>
                                <!-- User-->
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                        <img src="{{asset('assets/images/users/avatar-6.jpg')}}" alt="user" class="rounded-circle">
                                        <span class="d-none d-md-inline-block ml-1">Prueba <i class="mdi mdi-chevron-down"></i> </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                        <a class="dropdown-item" href="#"><i class="dripicons-user text-muted"></i>Mi Perfil</a>
                                        <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted"></i> Mi Dashboard</a>
                                        <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted"></i> Configuraci&oacute;n</a>
                                
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{route('logout')}}"><i class="dripicons-exit text-muted"></i> Cerrar Sesi&oacute;n</a>
                                    </div>
                                </li>
                                <li class="menu-item list-inline-item">
                                    <!-- Mobile menu toggle-->
                                    <a class="navbar-toggle nav-link">
                                        <div class="lines">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                    <!-- End mobile menu toggle-->
                                </li>

                            </ul>

                        </div>
                        <!-- end menu-extras -->

                        <div class="clearfix"></div>

                    </div> <!-- end container -->
                </div>
                <!-- end topbar-main -->

                <!-- MENU Start -->
                <div class="navbar-custom">
                    <div class="container-fluid">
                        <!-- Logo-->
                        <div class="d-none d-lg-block">
                          
                            <!-- Image Logo -->
                             <a href="·" class="logo">
                       
                                <img src="{{asset('assets/images/logo.png')}}" alt="" height="50" class="logo-large">
                            </a>

                        </div>
                        <!-- End Logo-->
                        <div id="navigation">

                            <!-- Navigation Menu-->
                            <ul class="navigation-menu">

                                <li class="has-submenu">
                                    <a href="{{route('home')}}"><i class="mdi mdi-home"></i>Agence</a>
                                </li>


                                <li class="has-submenu">
                                    <a href="{{route('home')}}"><i class="mdi mdi-file-check"></i>Proyectos</a>
                                </li>

                                <li class="has-submenu">
                                    <a href="{{route('home')}}"><i class="mdi mdi-table-edit"></i>Administrativo</a>
                                </li>

                                <li class="has-submenu">
                                    <a href="{{route('home')}}"><i class="mdi mdi-account-multiple-plus"></i>Comercial</a>
                                </li>

                                <li class="has-submenu">
                                    <a href="{{route('home')}}"><i class="mdi mdi-newspaper"></i>Financiero</a>
                                </li>

                                <li class="has-submenu">
                                    <a href="{{route('home')}}"><i class="mdi mdi-account-settings-variant"></i>Usuario</a>
                                </li>

                                <li class="has-submenu">
                                    <a href="{{route('home')}}"><i class="mdi mdi-logout"></i>Salir</a>
                                </li>
    
                              
                  
                              

                            </ul>
                            <!-- End navigation menu -->
                        </div> <!-- end #navigation -->
                    </div> <!-- end container -->
                </div> <!-- end navbar-custom -->
            </header>
            <!-- End Navigation Bar-->

            <div class="container-fluid">
                 @yield("guia")
            
            </div>
        </div>


        <div class="wrapper">
                @yield("content")
        </div>
        <!-- end wrapper -->


        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        © 2018 - {{date("Y")}} Prueba <span class="d-none d-md-inline-block"> - Creado <i class="mdi mdi-heart text-danger"></i> Duglas Moreno.</span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->
      
        @section('script')
        @include('layouts.partials.script')
        @show
        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>

    </body>
</html>
