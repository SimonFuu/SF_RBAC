@extends('layouts.layout')
@section('body')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">权限列表</h3>
                <div class="box-tools">
                    <a href="/system/actions/add" class="btn btn-primary btn-sm">添加</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover actions-list">
                    <thead>
                        <tr>
                            <th width="50">ID</th>
                            <th width="100">权限</th>
                            <th width="200">URLs</th>
                            <th width="100">权重</th>
                            <th width="200">描述</th>
                            <th width="50">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($actions as $action)
                            @if($action -> parentId != 0)
                                @php($urls = json_decode($action -> urls, true))
                                @php($urls = (implode('<br/>', ($urls ? $urls : []))))
                            @else
                                @php($urls = 'NaN')
                            @endif
                            <tr class="actions-list-trs">
                                <td>{{ $action -> id }}</td>
                                <td>{{ $action -> actionName }}</td>
                                <td><div class="actions-list-urls">{!!  $urls !!}</div></td>
                                <td>{{ $action -> weight }}</td>
                                <td>{{ $action -> description }}</td>
                                <td>
                                    <a href="/system/actions/edit?id={{ $action -> id }}"><i class="fa fa-pencil-square-o"></i></a>
                                    &nbsp;
                                    <a href="/system/actions/delete?id={{ $action -> id }}"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{ $actions -> links() }}
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection