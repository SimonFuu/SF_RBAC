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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper iframe-content-warpper">
        <div class="alert-area">
            @if (session('success'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">
                        &times;
                    </button>
                    {!! session('success') !!}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissable" id="deleteError">
                    <button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">
                        &times;
                    </button>
                    {!! session('error') !!}
                </div>
            @endif
        </div>
        @yield('body')
    </div>

    <!-- /.content-wrapper -->


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>

<!-- Modals -->
<!-- set-actions-modal -->
<div class="modal fade" id="setActionIconModal" tabindex="-1" role="dialog" aria-labelledby="setActionIconModalLabel">
    <div class="modal-dialog  modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="setActionIconModalLabel">Font Awesome Icons</h4>
            </div>
            <div class="modal-body set-actions-icons-list-modal">
                <table class="set-actions-icons-list">
                    <thead>
                    <tr>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary disabled set-actions-previous" data-previous="-1">
                                <i class="fa fa-arrow-left"></i>
                            </button>
                        </td>
                        <td class="text-center set-actions-page-info" colspan="5"> 1 / 0 </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary set-actions-next" data-next="-1">
                                <i class="fa fa-arrow-right"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <label class="set-actions-icon-label">
                                <input type="text" class="form-control set-actions-icon-name" placeholder="search icon">
                            </label>
                        </td>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary">提交</button>
            </div>
        </div>
    </div>
</div>
<!-- /.set-actions-modal -->

<!-- /.Modals -->

@if(env('APP_ENV') === 'local')
    <script src="/assets/js/app.js?v={{ date('YmdHi') }}"></script>
    <script src="/assets/plugins/AdminLte/js/app.min.js"></script>

@else
    <script src="//cdn.bootcss.com/admin-lte/2.3.11/js/app.min.js"></script>
    <script src="/assets/js/app.js?v={{ env('APP_ASSETS_VERSION') }}"></script>
@endif
</body>
</html>