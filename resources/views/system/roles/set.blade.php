@extends('layouts.layout')
@section('body')
    <!-- Main content -->
    <section class="content">
        <div class="box box-{{ is_null($role) ? 'info' : 'primary' }}">
            <div class="box-header with-border">
                <h3 class="box-title">{{ is_null($role) ? '添加' : '编辑'}}角色</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['url' => '/system/roles/store', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) !!}
                <!-- class include {'form-horizontal'|'form-inline'} -->
                <div class="box-body">
                    <!--- ActionName Field --->
                    <div class="form-group {{ $errors -> has('roleName') ? 'has-error' : '' }}">
                        {!! Form::label('roleName', '角色名称:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('roleName', is_null($role) ? null : $role -> roleName, ['class' => 'form-control', 'placeholder' => '请输入角色名称！']) !!}
                            @if($errors -> has('roleName'))
                                <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('roleName') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!--- Description Field --->
                    <div class="form-group {{ $errors -> has('description') ? 'has-error' : '' }}">
                        {!! Form::label('description', '描述:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('description', is_null($role) ? null : $role -> description, ['class' => 'form-control', 'placeholder' => '请输入角色描述！']) !!}
                            @if($errors -> has('description'))
                                <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!--- RoleActions Field --->
                    <div class="form-group {{ $errors -> has('actions') ? 'has-error' : '' }}">
                        {!! Form::label('roleActions', '角色权限:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <div class="role-actions-list">
                                @foreach($actions as $action)
                                    <div class="col-sm-3">
                                        <table class="table table-bordered table-condensed role-actions-list-table">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <label>
                                                        @if(is_null($role))
                                                            <input type="checkbox" name="actions[]" class="parentRoleAction" value="{{ $action['id'] }}">&nbsp;&nbsp;{{ $action['actionName'] }}
                                                        @else
                                                            <input type="checkbox" name="actions[]" class="parentRoleAction" value="{{ $action['id'] }}" {{ in_array($action['id'], $role -> aid) ? 'checked' : ''}}>&nbsp;&nbsp;{{ $action['actionName'] }}
                                                        @endif
                                                    </label>
                                                </td>
                                            </tr>
                                            @if($action['childrenMenus'])
                                                @foreach($action['childrenMenus'] as $cAction)
                                                    <tr>
                                                        <td>
                                                            <label class="child-role-action-label">
                                                                @if(is_null($role))
                                                                    <input type="checkbox" name="actions[]" class="childRoleAction" value="{{ $cAction['id'] }}">&nbsp;&nbsp;{{ $cAction['actionName'] }}
                                                                @else
                                                                    <input type="checkbox" name="actions[]" class="childRoleAction" value="{{ $cAction['id'] }}" {{ in_array($cAction['id'], $role -> aid) ? 'checked' : ''}}>&nbsp;&nbsp;{{ $cAction['actionName'] }}
                                                                @endif
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                            @if($errors -> has('actions'))
                                <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('actions') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    @if(!is_null($role))
                        <input type="hidden" name="id" value="{{ $role -> id }}">
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="/system/roles/list" class="btn btn-default">返回</a>
                    <button type="submit" class="btn btn-{{ is_null($role) ? 'info' : 'primary' }} pull-right">提交</button>
                </div>
                <!-- /.box-footer -->
            {!! Form::close() !!}
        </div>
    </section>
    <!-- /.content -->
@endsection