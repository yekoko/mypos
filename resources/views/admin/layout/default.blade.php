<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
     
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ asset('assets/img/icon.png') }}" />
    <title>
        @yield('title')    
    </title>
    <!-- global css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->

    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
   
     <link href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/styles/black.css') }}" rel="stylesheet" type="text/css" id="colorscheme" />
    <link href="{{ asset('assets/css/panel.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/metisMenu.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css"/>

    <!-- end of global css -->
    <!--page level css-->
    @yield('header_styles')
    <!--end of page level css-->
</head>

<body class="skin-josh">
    <header class="header">
        <a href="{{ route('dashboard') }}" class="logo">
            <img src="">
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <div>
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <div class="responsive_nav"></div>
                </a>
            </div>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="livicon" data-name="message-flag" data-loop="true" data-color="#42aaca" data-hovercolor="#42aaca" data-size="28"></i>
                            <span class="label label-success">0</span>
                        </a>
                        <ul class="dropdown-menu dropdown-messages pull-right">
                            <li class="dropdown-title">0 New Messages</li>
                             
                            <li class="footer">
                                <a href="#">View all</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="livicon" data-name="bell" data-loop="true" data-color="#e9573f" data-hovercolor="#e9573f" data-size="28"></i>
                            <span class="label label-warning noti-count"  >0</span>
                        </a>
                        <ul class=" notifications dropdown-menu">
                            <li class="dropdown-title">You have <span class="noti-count"></span>notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu" id="messages">
                                    
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if(Sentinel::getUser()->photo)
                                <img src="{!! url('/').'/uploads/users/'.Sentinel::getUser()->photo !!}" alt="img" class="img-circle img-responsive pull-left" height="35px" width="35px"/>
                            @else
                                <img src="{!! asset('assets/img/authors/avatar3.jpg') !!} " width="35" class="img-circle img-responsive pull-left" height="35" alt="riot">
                            @endif
                            <div class="riot">
                                <div>
                                    {{ Sentinel::getUser()->name }}
                                    <span>
                                        <i class="caret"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                @if(Sentinel::getUser()->photo)
                                    <img src="{!! url('/').'/uploads/users/'.Sentinel::getUser()->photo !!}" alt="img" class="img-circle img-bor"/>
                                @else
                                    <img src="{!! asset('assets/img/authors/avatar3.jpg') !!}" class="img-responsive img-circle" alt="User Image">
                                @endif
                                <p class="topprofiletext">{{ Sentinel::getUser()->name }}</p>
                            </li>
                            <!-- Menu Body -->
                             
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#">
                                        <i class="livicon" data-name="lock" data-s="18"></i>
                                        Lock
                                    </a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ URL::to('admin/logout') }}">
                                        <i class="livicon" data-name="sign-out" data-s="18"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <section class="sidebar ">
                <div class="page-sidebar  sidebar-nav">
                    <div class="nav_icons">
                        <ul class="sidebar_threeicons">
                            <li>
                                <a href="#">
                                    <i class="livicon" data-name="hammer" title="Form Builder 1" data-loop="true" data-color="#42aaca" data-hc="#42aaca" data-s="25"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="livicon" data-name="list-ul" title="Form Builder 2" data-loop="true" data-color="#e9573f" data-hc="#e9573f" data-s="25"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="livicon" data-name="vector-square" title="Button Builder" data-loop="true" data-color="#f6bb42" data-hc="#f6bb42" data-s="25"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="livicon" data-name="new-window" title="Form Builder 1" data-loop="true" data-color="#37bc9b" data-hc="#37bc9b" data-s="25"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul id="menu" class="page-sidebar-menu">
                        <li {!! (Request::is('admin') ? 'class="active"' : '') !!}>
                            <a href="{{ route('dashboard') }}">
                                <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        @if($user = Sentinel::getUser())
                        @if($user->inRole('admin'))
                        <li {!! (Request::is('admin/category') || Request::is('admin/category/*') ? 'class="active"' : '') !!}>
                            <a href="#">
                                <i class="livicon" data-name="users" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                <span class="title">Category</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('admin/category') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/category') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Category
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/category/create') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/category/create') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Add New Category
                                    </a>
                                </li>
                                 
                            </ul>
                        </li>
                         <li {!! (Request::is('admin/company') || Request::is('admin/company/*') ? 'class="active"' : '') !!}>
                            <a href="#">
                                <i class="livicon" data-name="users" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                <span class="title">Company</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('admin/company') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/company') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Company
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/company/create') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/company/create') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Add New Company
                                    </a>
                                </li>
                                 
                            </ul>
                        </li>
                        <li {!! (Request::is('admin/experience') || Request::is('admin/experience/*') ? 'class="active"' : '') !!}>
                            <a href="#">
                                <i class="livicon" data-name="users" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                <span class="title">Experience</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('admin/experience') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/experience') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Experience
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/experience/create') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/experience/create') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Add New Experience
                                    </a>
                                </li>
                                 
                            </ul>
                        </li>
                        <li {!! (Request::is('admin/industry') || Request::is('admin/industry/*') ? 'class="active"' : '') !!}>
                            <a href="#">
                                <i class="livicon" data-name="users" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                <span class="title">Industry</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('admin/industry') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/industry') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Industry
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/industry/create') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/industry/create') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Add New Industry
                                    </a>
                                </li>
                                 
                            </ul>
                        </li>
                        @endif
                        @if($user->inRole('admin') || $user->inRole('company'))
                        <li {!! (Request::is('admin/job') || Request::is('admin/job/*') ? 'class="active"' : '') !!}>
                            <a href="#">
                                <i class="livicon" data-name="users" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                <span class="title">Job</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('admin/job') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/job') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Job
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/job/create') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/job/create') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Add New Job
                                    </a>
                                </li>
                                 
                            </ul>
                        </li>
                        @endif
                        @if($user->inRole('admin'))
                        <li {!! (Request::is('admin/language') || Request::is('admin/language/*') ? 'class="active"' : '') !!}>
                            <a href="#">
                                <i class="livicon" data-name="users" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                <span class="title">Language</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('admin/language') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/language') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        language
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/language/create') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/language/create') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Add New language
                                    </a>
                                </li>
                                 
                            </ul>
                        </li>
                        
                        <li {!! (Request::is('admin/user') || Request::is('admin/user/*') ? 'class="active"' : '') !!}>
                            <a href="#">
                                <i class="livicon" data-name="users" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                <span class="title">Users</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('admin/user') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/user') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        User
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/user/create') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/user/create') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Add New User
                                    </a>
                                </li>
                                 
                            </ul>
                        </li>
                        <li {!! (Request::is('admin/role') || Request::is('admin/role/*') ? 'class="active"' : '') !!}>
                            <a href="#">
                                <i class="livicon" data-name="columns" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                <span class="title">Roles</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('admin/role') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/role') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Role
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/role/create') ? 'class="active"' : '') !!}>
                                    <a href="{!! URL::to('admin/role/create') !!}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Add New Role
                                    </a>
                                </li>
                                 
                            </ul>
                        </li>
                        @endif
                        @endif
                         
                        <!-- Menus generated by CRUD generator -->
                        @include('admin/layout/menu')
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
            </section>
        </aside>
        <aside class="right-side">
                        
            <!-- Content -->
            @yield('content')

        </aside>
        <!-- right-side -->
    </div>
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top" data-toggle="tooltip" data-placement="left">
        <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
    </a>
    <!-- global js -->
    <script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

    
    <!--livicons-->
    <script src="{{ asset('assets/vendors/livicons/minified/raphael-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/livicons/minified/livicons-1.4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/josh.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/metisMenu.js') }}" type="text/javascript"> </script>
    <script src="{{ asset('assets/vendors/holder-master/holder.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/ion.sound/ion.sound.min.js') }}" type="text/javascript"></script>
    <!-- end of global js -->
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
    <!-- begin page level js -->

    <script src="{{ asset('assets/vendors/daterangepicker/moment.min.js') }}" ></script>
    <!-- date-range-picker -->
    <script src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"  type="text/javascript"></script>

    @yield('footer_scripts')
    <!-- end page level js -->
  <script>

	

    </script>
</body>
</html>
