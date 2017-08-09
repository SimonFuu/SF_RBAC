<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SystemActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "actionName" => "首页",
                "description" => "系统首页，所有人都可以访问",
                "menuUrl" => "main",
                "icon" => "fa-tachometer",
                "urls" => json_encode(["main"]),
                "parentId" => 0
            ],
            [
                "actionName" => "系统管理",
                "description" => "用于系统整体的配置，包含用户管理，权限管理，部门管理等",
                "menuUrl" => "system",
                "icon" => "fa-cogs",
                "urls" => json_encode(["system"]),
                "parentId" => 0
            ],
            [
                "actionName" => "用户管理",
                "description" => "添加、修改、删除系统用户",
                "menuUrl" => "system/users/list",
                "icon" => "fa-circle-o",
                "urls" => json_encode(["system/users/list","system/users/add","system/users/edit","system/users/store","system/users/delete"]),
                "parentId" => 2
            ],
            [
                "actionName" => "角色管理",
                "description" => "添加、修改、删除后台管理员角色",
                "menuUrl" => "system/roles/list",
                "icon" => "fa-circle-o",
                "urls" => json_encode(["system/roles/list","system/roles/add","system/roles/edit","system/roles/store","system/roles/delete"]),
                "parentId" => 2
            ],
            [
                "actionName" => "菜单权限管理",
                "description" => "添加、修改、删除当前系统的所有权限",
                "menuUrl" => "system/actions/list",
                "icon" => "fa-circle-o",
                "urls" => json_encode(["system/actions/list","system/actions/add","system/actions/edit","system/actions/store","system/actions/delete"]),
                "parentId" => 2
            ],
        ];
        DB::beginTransaction();
        try {
            DB::table("system_actions")
                -> insert($data);
            DB::commit();
        } catch (Exception $e) {
            Log::emergency($e -> getMessage());
            DB::rollback();
        }
    }
}
