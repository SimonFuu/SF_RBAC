@extends('layouts.layout')
@section('body')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">角色列表</h3>
                <div class="box-tools">
                    <a href="/system/roles/add" class="btn btn-primary btn-sm">添加</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover actions-list">
                    <thead>
                        <tr>
                            <th width="50">ID</th>
                            <th width="100">角色</th>
                            <th width="200">描述</th>
                            <th width="50">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr class="actions-list-trs">
                                <td>{{ $role -> id }}</td>
                                <td>{{ $role -> roleName }}</td>
                                <td>{{ $role -> description }}</td>
                                <td>
                                    <a href="/system/roles/edit?id={{ $role -> id }}"><i class="fa fa-pencil-square-o"></i></a>
                                    &nbsp;
                                    <a href="/system/roles/delete?id={{ $role -> id }}"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{ $roles -> links() }}
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection