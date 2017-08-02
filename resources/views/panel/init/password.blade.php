<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @if(env('APP_ENV') === 'local')
        <link rel="stylesheet" href="/assets/plugins/bootstrap-3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/plugins/fontawesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/css/layouts.css?v={{ date('YmdHi') }}">
        <script src="/assets/plugins/jquery-3.2.1/jquery-3.2.1.min.js"></script>
        <script src="/assets/plugins/bootstrap-3.3.7/js/bootstrap.min.js"></script>
    @else
        <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="/assets/css/layouts.css?v={{ env('APP_ASSETS_VERSION') }}" rel="stylesheet">
        <script src="//cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @endif

</head>
<body>
<div class="init-password-padding-15">
    <div class="init-password-box">
        <div class="init-password-logo">
            {{--<img src="" alt="">--}}
            Logo
        </div>
        <div class="init-password-form">
        {!! Form::open(['url' => '/panel/init/password', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) !!}
        <!-- class include {'form-horizontal'|'form-inline'} -->
            <header><i class="fa fa-users"></i> 修改密码</header>
            <div class="init-password-form-filed">
                <div class="form-group init-password-notice">
                    <div class="alert alert-info" role="alert">首次登录系统，请先修改密码！</div>
                </div>
                <!--- Password Field --->
                <div class="form-group {{ $errors -> has('password') ? 'has-error' : '' }}">
                    {!! Form::label('password', '密码:', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                <!--- Password Confirmation Field --->
                <div class="form-group {{ $errors -> has('password') ? 'has-error' : '' }}">
                    {!! Form::label('password_confirmation', '确认密码:', ['class' => 'control-label']) !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    @if($errors -> has('password'))
                        <span class="help-block">
                            <strong>{{ $errors -> first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <hr>
            </div>
            <footer>
                <button class="init-password-footers btn btn-info pull-right" type="submit">修改</button>
            </footer>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@if(env('APP_ENV') === 'local')
    <script src="/assets/js/app.js?v={{ date('YmdHi') }}"></script>
@else
    <script src="/assets/js/app.js?v={{ env('APP_ASSETS_VERSION') }}"></script>
@endif
</body>
</html>