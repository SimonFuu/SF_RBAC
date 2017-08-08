@extends('layouts.layout')
@section('body')
    <!-- Main content -->
    <section class="content">
        <div class="box box-{{ is_null($userProfile) ? 'info' : 'primary' }}">
            <div class="box-header with-border">
                <h3 class="box-title">{{ is_null($userProfile) ? '添加' : '编辑'}}用户</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

        {!! Form::open(['url' => '/panel/user/store', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
        <!-- class include {'form-horizontal'|'form-inline'} -->
            <div class="box-body">
                <div id="kv-avatar-errors-2" class="center-block" style="display:none"></div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="kv-avatar center-block text-center" style="max-width:200px" data-avatar="{{ env('APP_FILE_SERVER_URL') . Auth() -> user() -> avatar }}">
                            <input id="avatar" name="file" type="file" class="file-loading" accept="image/*">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <!--- Username Field --->
                        <div class="form-group {{ $errors -> has('username') ? 'has-error' : '' }}">
                            {!! Form::label('username', '用户名:', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('username', is_null($userProfile) ? null : $userProfile -> username, ['class' => 'form-control', 'placeholder' => '请输入用户名！', is_null($userProfile) ? '' : 'readonly']) !!}
                                @if($errors -> has('username'))
                                    <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('username') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <!--- Name Field --->
                        <div class="form-group {{ $errors -> has('name') ? 'has-error' : '' }}">
                            {!! Form::label('name', '姓名:', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('name', is_null($userProfile) ? null : $userProfile -> name, ['class' => 'form-control', 'placeholder' => '请输入用户姓名！']) !!}
                                @if($errors -> has('name'))
                                    <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <!--- Password Field --->
                        <div class="form-group {{ $errors -> has('password') ? 'has-error' : '' }}">
                            {!! Form::label('password', '密码:', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '请输入密码！']) !!}
                                @if($errors -> has('password'))
                                    <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <!--- Password Confirmation Field --->
                        <div class="form-group {{ $errors -> has('password') ? 'has-error' : '' }}">
                            {!! Form::label('password', '确认密码:', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => '请重新输入密码！']) !!}
                                @if($errors -> has('password'))
                                    <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <!--- Telephone Field --->
                        <div class="form-group {{ $errors -> has('telephone') ? 'has-error' : '' }}">
                            {!! Form::label('telephone', '电话:', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('telephone', is_null($userProfile) ? null : $userProfile -> telephone, ['class' => 'form-control', 'placeholder' => '请输入电话！']) !!}
                                @if($errors -> has('telephone'))
                                    <span class="help-block form-help-block">
                                <strong>{{ $errors -> first('telephone') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <!--- Email Field --->
                        <div class="form-group {{ $errors -> has('email') ? 'has-error' : '' }}">
                            {!! Form::label('email', 'E-mail:', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::email('email', is_null($userProfile) ? null : $userProfile -> email, ['class' => 'form-control', 'placeholder' => '请输入邮箱！']) !!}
                                @if($errors -> has('email'))
                                    <span class="help-block form-help-block">
                                <strong>{{ $errors -> first('email') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>


                        <!--- Gender Field --->
                        <div class="form-group {{ $errors -> has('gender') ? 'has-error' : '' }}">
                            {!! Form::label('gender', '性别:', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">

                                @if(is_null($userProfile))
                                    <label class="radio-inline">
                                        {!! Form::radio('gender', 0, 'checked') !!}男
                                    </label>
                                    <label class="radio-inline">
                                        {!! Form::radio('gender', 1) !!}女
                                    </label>
                                @else
                                    <label class="radio-inline">
                                        {!! Form::radio('gender', 0, ($userProfile -> gender == 0 ? 'checked' : '')) !!}男
                                    </label>
                                    <label class="radio-inline">
                                        {!! Form::radio('gender', 1, ($userProfile -> gender == 1 ? 'checked' : '')) !!}女
                                    </label>
                                @endif
                                @if($errors -> has('gender'))
                                    <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('gender') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="/panel/user/center?id={{ Auth() -> user() -> id }}" class="btn btn-default">返回</a>
                <button type="submit" class="btn btn-{{ is_null($userProfile) ? 'info' : 'primary' }} pull-right">提交</button>
            </div>
            <!-- /.box-footer -->
            {!! Form::close() !!}

        </div>
    </section>
    <!-- /.content -->
@endsection