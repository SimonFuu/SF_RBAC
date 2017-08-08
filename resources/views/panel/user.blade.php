@extends('layouts.layout')
@section('body')
    <!-- Main content -->
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">个人中心</h3>
                <div class="box-tools">
                    <a href="/panel/user/edit" class="btn btn-primary btn-sm">编辑</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table user-profile-table">
                    <tbody>
                        <tr>
                            <th class="text-center" width="250">用户名：</th>
                            <td class="text-center" width="200">
                                {{ $userProfile -> username }}
                            </td>
                            <td rowspan="3">
                                <div class="user-profile-avatar">
                                    <img src="{{ env('APP_FILE_SERVER_URL') . $userProfile -> avatar}}" alt="头像" width="160" height="160">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">姓名：</th>
                            <td class="text-center">
                                <span class="user-profile-filed">
                                    {{ $userProfile -> name }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">性别：</th>
                            <td class="text-center">
                                <span class="user-profile-filed">
                                    {{ $userProfile -> gender == 0 ? '男' : '女' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">电话：</th>
                            <td class="text-center">
                                <span class="user-profile-filed">
                                    {{ is_null($userProfile -> telephone) ? '空'  : $userProfile -> telephone}}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">邮箱：</th>
                            <td class="text-center">
                                <span class="user-profile-filed">
                                    {{ is_null($userProfile -> email) ? '空'  : $userProfile -> email }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
@endsection