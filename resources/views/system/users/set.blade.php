@extends('layouts.layout')
@section('body')
    <!-- Main content -->
    <section class="content">
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                &times;
            </button>
            <i class="icon fa fa-warning"></i>本页面仅{{ is_null($user) ? '添加' : '编辑'}}后台管理员用户！如需{{ is_null($user) ? '添加' : '编辑'}}业务用户，请到 <a href="#"><strong>人员管理</strong></a>！
        </div>
        <div class="box box-{{ is_null($user) ? 'info' : 'primary' }}">
            <div class="box-header with-border">
                <h3 class="box-title">{{ is_null($user) ? '添加' : '编辑'}}用户</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['url' => '/system/users/store', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) !!}
                <!-- class include {'form-horizontal'|'form-inline'} -->
                <div class="box-body">
                    <!--- Username Field --->
                    <div class="form-group {{ $errors -> has('username') ? 'has-error' : '' }}">
                        {!! Form::label('username', '用户名:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('username', is_null($user) ? null : $user -> username, ['class' => 'form-control', 'placeholder' => '请输入用户名！']) !!}
                            @if($errors -> has('username'))
                                <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('username') }}</strong>
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

                    <!--- Name Field --->
                    <div class="form-group {{ $errors -> has('name') ? 'has-error' : '' }}">
                        {!! Form::label('name', '姓名:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('name', is_null($user) ? null : $user -> name, ['class' => 'form-control', 'placeholder' => '请输入用户姓名！']) !!}
                            @if($errors -> has('name'))
                                <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!--- Gender Field --->
                    <div class="form-group {{ $errors -> has('gender') ? 'has-error' : '' }}">
                        {!! Form::label('gender', '性别:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                {!! Form::radio('gender', 0, 'checked') !!}男
                            </label>
                            <label class="radio-inline">
                                {!! Form::radio('gender', 1) !!}女
                            </label>
                            @if($errors -> has('gender'))
                                <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('gender') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!--- UserRoles Field --->
                    <div class="form-group {{ $errors -> has('roles') ? 'has-error' : '' }}">
                        {!! Form::label('roles', '用户角色:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <div class="user-roles-list">
                                @foreach($roles as $role)
                                    <div class="col-sm-3">
                                        <table class="table table-bordered table-condensed user-roles-list-table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label>
                                                            @if(is_null($user))
                                                                <input type="checkbox" name="roles[]" value="{{ $role -> id }}">&nbsp;&nbsp;{{ $role -> roleName }}
                                                            @else
                                                                <input type="checkbox" name="roles[]" value="{{ $role -> id }}" {{ in_array($role -> id, $user -> rid) ? 'checked' : ''}}>&nbsp;&nbsp;{{ $role['roleName'] }}
                                                            @endif
                                                        </label>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                            @if($errors -> has('roles'))
                                <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('roles') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="isAdmin" value="1">
                    @if(!is_null($user))
                        <input type="hidden" name="id" value="{{ $user -> id }}">
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="/system/users/list" class="btn btn-default">返回</a>
                    <button type="submit" class="btn btn-{{ is_null($user) ? 'info' : 'primary' }} pull-right">提交</button>
                </div>
                <!-- /.box-footer -->
            {!! Form::close() !!}
        </div>
    </section>
    <!-- /.content -->
@endsection