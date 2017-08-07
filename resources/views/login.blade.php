<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP') }}</title>
    @if(env('APP_ENV') === 'local')
        <link rel="stylesheet" href="/assets/plugins/bootstrap-3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css">
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
<div class="login-padding-15">
    <div class="login-box">
        <div class="login-logo">
            {{--<img src="" alt="">--}}
            Logo
        </div>
        <div class="login-form">
        {!! Form::open(['url' => '/login', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) !!}
        <!-- class include {'form-horizontal'|'form-inline'} -->
            <header><i class="fa fa-users"></i> 登录</header>
            <div class="login-form-filed">
                @if (session('success'))
                    <div class="form-group">
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">
                                &times;
                            </button>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="form-group">
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">
                                &times;
                            </button>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                <!--- Username Field --->
                <div class="form-group {{ $errors -> has('username') ? 'has-error' : '' }}">
                    {!! Form::label('username', '用户名:', ['class' => 'control-label']) !!}
                    {!! Form::text('username', null, ['class' => 'form-control']) !!}
                </div>
                <!--- Password Field --->
                <div class="form-group {{ $errors -> has('username') ? 'has-error' : '' }}">
                    {!! Form::label('password', '密码:', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    @if($errors -> has('username'))
                        <span class="help-block">
                            <strong>{{ $errors -> first('username') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group login-remember-me">
                    <label>
                        <input type="checkbox"> 记住我
                    </label>
                </div>
                <hr>
            </div>
            <footer>
                {{--<div class="login-footers login-forget-password pull-left">--}}
                    {{--<a href="">忘记密码?</a>--}}
                {{--</div>--}}
                <button class="login-footers btn btn-info pull-right" type="submit">登录</button>
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