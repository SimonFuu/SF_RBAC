@extends('layouts.layout')
@section('body')
    <!-- Main content -->
    <section class="content">
        <div class="box box-{{ is_null($action) ? 'info' : 'primary' }}">
            <div class="box-header with-border">
                <h3 class="box-title">{{ is_null($action) ? '添加' : '编辑'}}权限</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['url' => '/system/actions/store', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) !!}
                <!-- class include {'form-horizontal'|'form-inline'} -->
                <div class="box-body">
                    <!--- ActionName Field --->
                    <div class="form-group {{ $errors -> has('actionName') ? 'has-error' : '' }}">
                        {!! Form::label('actionName', '权限名称:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('actionName', is_null($action) ? null : $action -> actionName, ['class' => 'form-control', 'placeholder' => '请输入权限名称！']) !!}
                            @if($errors -> has('actionName'))
                                <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('actionName') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!--- MenuUrl Field --->
                    <div class="form-group {{ $errors -> has('menuUrl') ? 'has-error' : '' }}">
                        {!! Form::label('menuUrl', '菜单URL:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('menuUrl', is_null($action) ? null : $action -> menuUrl, ['class' => 'form-control', 'placeholder' => '菜单URL！']) !!}
                            @if($errors -> has('menuUrl'))
                                <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('menuUrl') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!--- Icon Field --->
                    <div class="form-group {{ $errors -> has('icon') ? 'has-error' : '' }}">
                        {!! Form::label('menuUrl', '菜单图标:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <button class="btn btn-{{ $errors -> has('icon') ? 'danger' : 'default' }} set-action-icon" type="button" data-toggle="modal" data-target="#setActionIconModal"><i class="fa fa-circle-o" aria-hidden="true"></i></button>
                            &nbsp;&nbsp;&nbsp;<i class="fa fa-hand-o-left" aria-hidden="true"></i> 请点击选择图标
                            <input class="set-action-icon-value" type="hidden" name="icon" value="fa-circle-o">
                            @if($errors -> has('icon'))
                                <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('icon') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!--- Urls Field --->
                    <div class="form-group {{ $errors -> has('urls') ? 'has-error' : '' }}">
                        {!! Form::label('urls', 'Urls:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            @if(!is_null($action))
                                @php
                                    $urls = json_decode($action -> urls, true);
                                    $urls = (implode("\r\n", ($urls ? $urls : [])));
                                @endphp
                            @endif
                            {!! Form::textarea('urls', is_null($action) ? null : $urls, ['class' => 'form-control', 'rows' => 5, 'placeholder' => '权限所有URL，一行一个！']) !!}
                            @if($errors -> has('urls'))
                                <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('urls') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!--- Weight Field --->
                    <div class="form-group {{ $errors -> has('weight') ? 'has-error' : '' }}">
                        {!! Form::label('weight', '展示权重:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::number('weight', is_null($action) ? 1000 : $action -> weight, ['class' => 'form-control']) !!}
                            @if($errors -> has('weight'))
                                <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('weight') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!--- Description Field --->
                    <div class="form-group {{ $errors -> has('description') ? 'has-error' : '' }}">
                        {!! Form::label('description', '描述:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('description', is_null($action) ? null : $action -> description, ['class' => 'form-control']) !!}
                            @if($errors -> has('description'))
                                <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!--- ParentId Field --->
                    <div class="form-group {{ $errors -> has('parentId') ? 'has-error' : '' }}">
                        {!! Form::label('parentId', '父级菜单:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('parentId', $pActions, is_null($action) ? null : $action -> parentId, ['class' => 'form-control']) !!}
                            @if($errors -> has('parentId'))
                                <span class="help-block form-help-block">
                                    <strong>{{ $errors -> first('parentId') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    @if(!is_null($action))
                        <input type="hidden" name="id" value="{{ $action -> id }}">
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="/system/actions/list" class="btn btn-default">返回</a>
                    <button type="submit" class="btn btn-{{ is_null($action) ? 'info' : 'primary' }} pull-right">提交</button>
                </div>
                <!-- /.box-footer -->
            {!! Form::close() !!}
        </div>
    </section>
    <!-- /.content -->
    <script>
        var actionIcons = '{!! $icons !!}';
    </script>
@endsection