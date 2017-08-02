<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @if(env('APP_ENV') === 'local')
        <link rel="stylesheet" href="/assets/plugins/bootstrap-3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/plugins/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="/assets/plugins/AdminLte/css/AdminLTE.min.css">
        <link rel="stylesheet" href="/assets/plugins/AdminLte/css/skin-blue.min.css">
        <link rel="stylesheet" href="/assets/css/layouts.css?v={{ date('YmdHi') }}">
        <script src="/assets/plugins/jquery-3.2.1/jquery-3.2.1.min.js"></script>
        <script src="/assets/plugins/bootstrap-3.3.7/js/bootstrap.min.js"></script>
    @else
        <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">
        <link href="//cdn.bootcss.com/admin-lte/2.3.11/css/AdminLTE.min.css" rel="stylesheet">
        <link href="//cdn.bootcss.com/admin-lte/2.3.11/css/skins/skin-blue.css" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/layouts.css?v={{ env('APP_ASSETS_VERSION') }}">
        <script src="//cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @endif
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="/index" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>后台</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>管理</b>后台</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                <!-- inner menu: contains the messages -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <!-- User Image -->
                                                <img src="{{ env('APP_FILE_SERVER_URL') . Auth() -> user() -> avatar }}" class="img-circle" alt="User Image">
                                            </div>
                                            <!-- Message title and timestamp -->
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <!-- The message -->
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <!-- end message -->
                                </ul>
                                <!-- /.menu -->
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- /.messages-menu -->

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
                    <!-- Tasks Menu -->
                    <li class="dropdown tasks-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 9 tasks</li>
                            <li>
                                <!-- Inner menu: contains the tasks -->
                                <ul class="menu">
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <!-- Task title and progress text -->
                                            <h3>
                                                Design some buttons
                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <!-- The progress bar -->
                                            <div class="progress xs">
                                                <!-- Change the css width attribute to simulate progress -->
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ env('APP_FILE_SERVER_URL') . Auth() -> user() -> avatar }}" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth() -> user() -> name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ env('APP_FILE_SERVER_URL') . Auth() -> user() -> avatar }}" class="img-circle" alt="User Image">

                                <p>
                                    {{ Auth() -> user() -> name }}
                                    <small>Member since {{ date("D, d M Y", strtotime(Auth() -> user() -> addTime)) }}</small>
                                    <small>Last login ip:{{ Auth() -> user() -> lastLoginIp }}. Login times:{{ Auth() -> user() -> loginTimes }} </small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="/panel/user/center?id={{ Auth() -> user() -> id}}" class="btn btn-default btn-flat" target="content-iframe">个人中心</a>
                                </div>
                                <div class="pull-right">
                                    <a href="/logout" class="btn btn-default btn-flat">退出</a>
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
                    <img src="{{ env('APP_FILE_SERVER_URL') . Auth() -> user() -> avatar }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth() -> user() -> name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                @foreach(session('menus') as $key => $menu)
                    @if($menu['childrenMenus'])
                        <li class="sidebar-menu-item treeview">
                            <a href="javascript:void(0)"><i class="fa {{ $menu['icon'] }}" aria-hidden="true"></i><span> {{ $menu['actionName'] }}</span>
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu" style="display: none">
                                @foreach($menu['childrenMenus'] as $childMenu)
                                    <li><a href="{{ $childMenu['menuUrl'] }}" target="content-iframe"><i class="fa {{ $childMenu['icon'] }}" aria-hidden="true"></i>{{ $childMenu['actionName'] }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="sidebar-menu-item {{ $key == 0 ? 'active' : '' }}"><a href="{{ $menu['menuUrl'] }}" target="content-iframe"><i class="fa {{ $menu['icon'] }}" aria-hidden="true"></i><span> {{ $menu['actionName'] }}</span></a></li>
                    @endif
                @endforeach
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper parent-window-content-wapper">
        <div class="content body">
            <iframe src="main" frameborder="0" name="content-iframe" class="content-iframe"></iframe>
        </div>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Code By <a href="https://www.fushupeng.com" target="_blank">Simon Fu</a>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{ date('Y') }}.</strong> All rights reserved.
    </footer>
</div>
@if(env('APP_ENV') === 'local')
    <script src="/assets/plugins/AdminLte/js/app.min.js"></script>
    <script src="/assets/js/app.js?v={{ date('YmdHi') }}"></script>
@else
    <script src="//cdn.bootcss.com/admin-lte/2.3.11/js/app.min.js"></script>
    <script src="/assets/js/app.js?v={{ env('APP_ASSETS_VERSION') }}"></script>
@endif
</body>
</html>