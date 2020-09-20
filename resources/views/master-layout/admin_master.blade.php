<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">  
        @yield('title')       
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{asset('public/admin-asset/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('public/admin-asset/font-awesome/css/font-awesome.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{asset('public/admin-asset/css/ionicons.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('public/admin-asset/css/AdminLTE.min.css')}}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{asset('public/admin-asset/css/_all-skins.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/admin-asset/css/sweetalert.css')}}">
         @yield('custom_css')
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
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="{{url('admin/dashboard')}}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>T</b>TA</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Technical Test </b>Admin</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->

                    <div class="navbar-custom-menu">
                        <div class="col-md-12">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <a href="{{url('admin/logout')}}"  class="fa fa-lock btn-sm text-bold text-red">Logout</a>
                            </div>
                        </div>
                    </div>
                </nav>

            </header>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                @yield('main-sidebar') 
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->

                    <div class="user-panel">
                        <div class="pull-left image">
                            @if(!empty(Auth::guard('web_admin')->user()->image))
                            <img src="{{asset('public/admin-asset/images/'.Auth::guard('web_admin')->user()->image)}}" class="img-circle" alt="User Image">
                            @else
                            <img src="{{asset('public/admin-asset/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                            @endif
                        </div>
                        <div class="pull-left info">
                            <p>{{Auth::guard('web_admin')->user()->name}}</p>
                            <a href="{{url('admin/dashboard')}}"><i class="fa fa-circle text-success"></i> {{trans('labels.22')}}</a>
                        </div>
                    </div> 
                    @yield('Sidebar-user-panel')  
                    <!-- search form -->
                    @yield('Sidebar-search-form')
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MAIN NAVIGATION</li>
                        @if(Session::get('page')== "dashboard")
                        <?php $active = "active"; ?>
                        @else
                        <?php $active = ""; ?>
                        @endif                        
                        <li class="nav-link {{$active}}">
                            <a href="{{url('admin/dashboard')}}">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>                                
                            </a>                           
                        </li>
                        @if(Session::get('page')== "update-admin-password" || Session::get('page')== "update-admin-details")
                        <?php  $active = "active"; ?>
                        @else
                        <?php $active = ""; ?>
                        @endif  
                        <li class="treeview nav-link {{$active}} ">
                            <a href="#">
                                <i class="fa fa-th"></i> <span>Setting</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                @if(Session::get('page')== "update-admin-password")
                                <?php $active = "active"; ?>
                                @else
                                <?php $active = ""; ?>
                                @endif  
                                <li class="nav-link {{$active}}"><a href="{{url('admin/update-admin-password')}}"><i class="fa fa-circle-o"></i> Update Password</a></li>
                                @if(Session::get('page')== "update-admin-details")
                                <?php $active = "active"; ?>
                                @else
                                <?php $active = ""; ?>
                                @endif  
                                <li class="nav-link {{$active}}"><a href="{{url('admin/update-admin-details')}}"><i class="fa fa-circle-o"></i>  Update Details</a></li>
                            </ul>
                        </li>
                        
                         @if(Session::get('page')== "sections" || Session::get('page')== "categories" || Session::get('page')== "master-product")
                        <?php  $active = "active"; ?>
                        @else
                        <?php $active = ""; ?>
                        @endif  
                         <li class="treeview nav-link {{$active}} ">
                            <a href="#">
                                <i class="fa fa-th"></i> <span>catalogues</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                @if(Session::get('page')== "sections")
                                <?php $active = "active"; ?>
                                @else
                                <?php $active = ""; ?>
                                @endif  
                                <li class="nav-link {{$active}}"><a href="{{url('admin/sections')}}"><i class="fa fa-circle-o"></i>Sections</a></li>
                                @if(Session::get('page')== "categories")
                                <?php $active = "active"; ?>
                                @else
                                <?php $active = ""; ?>
                                @endif  
                                <li class="nav-link {{$active}}"><a href="{{url('admin/categories')}}"><i class="fa fa-circle-o"></i>Categories</a></li>
              @if(Session::get('page')== "master-product")              
 <?php $active = "active"; ?>
                                @else
                                <?php $active = ""; ?>
                                @endif  
                                <li class="nav-link {{$active}}"><a href="{{url('admin/master-product')}}"><i class="fa fa-circle-o"></i>Master Product</a></li>
                           
                            
                            </ul>
                        </li>
                    </ul>               
                </section>
                <!-- /.sidebar -->
            </aside>
            <!-- =============================================== -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    @yield('Main-content-header')  
                    @yield('Main-content-error-message')  
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    @yield('Main-content') 
                    <!-- /.box -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> N/A
                </div>
                <strong>Copyright &copy; 2020-2025 <a href="#">Priyodas Garai</a>.</strong> All rights
                reserved.
            </footer>

            <!-- Control Sidebar -->
            @yield('Control-Sidebar')     

            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="{{asset('public/admin-asset/js/jquery.min.js')}}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{asset('public/admin-asset/js/bootstrap.min.js')}}"></script>
        <!-- SlimScroll -->
        <script src="{{asset('public/admin-asset/js/jquery.slimscroll.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{asset('public/admin-asset/js/fastclick.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('public/admin-asset/js/adminlte.min.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{asset('public/admin-asset/js/demo.js')}}"></script>
        <script src="{{asset('public/admin-asset/js/sweetalert.min.js')}}"></script>
         @yield('custom_js')     
        <script>
            $(document).ready(function () {
                $('.sidebar-menu').tree();
                    
    
            })
        </script>
        
    </body>
</html>
