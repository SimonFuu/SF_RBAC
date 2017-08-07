<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $searchCondition = [];

    const PER_PAGE_RECORD_COUNT = 10;

    public function getRoleActionsInfo($roleId = 0)
    {
        $basePermissions = [
            'index',
            'notify',
            'panel/init/password',
            'panel/user/center'
        ];
        $permissions = [];
        $m = [];
        $menus = [];
        $cMenus = [];  // 临时存放二级菜单 key为父级菜单的id
        if ($roleId == 0) {
            $rawActions = DB::table('system_actions')
                -> select('id', 'actionName', 'description', 'menuUrl', 'icon', 'urls', 'parentId')
                -> orderBy('weight', 'ASC')
                -> where('isDelete', 0)
                -> get();
        } else {
            if (is_array($roleId)) {
                $rawActions = DB::table('system_actions')
                    -> select('system_actions.id', 'system_actions.actionName', 'system_actions.description',
                        'system_actions.menuUrl', 'system_actions.icon', 'system_actions.urls', 'system_actions.parentId')
                    -> leftJoin('system_roles_actions', 'system_roles_actions.aid', '=', 'system_actions.id')
                    -> orderBy('system_actions.weight', 'ASC')
                    -> where('system_actions.isDelete', 0)
                    -> where('system_roles_actions.isDelete', 0)
                    -> whereIn('system_roles_actions.rid', $roleId)
                    -> get();
            } else {
                $rawActions = DB::table('system_actions')
                    -> select('system_actions.id', 'system_actions.actionName', 'system_actions.description',
                        'system_actions.menuUrl', 'system_actions.icon', 'system_actions.urls', 'system_actions.parentId')
                    -> leftJoin('system_roles_actions', 'system_roles_actions.aid', '=', 'system_actions.id')
                    -> orderBy('system_actions.weight', 'ASC')
                    -> where('system_actions.isDelete', 0)
                    -> where('system_roles_actions.isDelete', 0)
                    -> where('system_roles_actions.rid', $roleId)
                    -> get();
            }
        }
        if ($rawActions) {
            foreach ($basePermissions as $permission) {
                $permissions[$permission] = 1;
            }
            foreach ($rawActions as $rawAction) {
                $urls = json_decode($rawAction -> urls, true);
                # 获取权限
                if ($urls) {
                    foreach ($urls as $url) {
                        $permissions[$url] = 1;
                    }
                }
                if ($rawAction -> parentId == 0) {
                    $m[] = [
                        'id' => $rawAction -> id,
                        'actionName' => $rawAction -> actionName,
                        'menuUrl' => $rawAction -> menuUrl,
                        'icon' => $rawAction -> icon,
                        'childrenMenus' => []
                    ];
                } else {
                    $cMenus[$rawAction -> parentId][] = [
                        'id' => $rawAction -> id,
                        'actionName' => $rawAction -> actionName,
                        'menuUrl' => $rawAction -> menuUrl,
                        'icon' => $rawAction -> icon,
                    ];
                }
            }
            // 生成菜单列表（二维数组）
            $existMenuIds = [];
            foreach ($m as $key => $menu) {
                if (!isset($existMenuIds[$menu['id']])) {
                    $existMenuIds[$menu['id']] = 1;
                    $menus[$key] = $menu;
                    if (isset($cMenus[$menu['id']])) {
                        $menus[$key]['childrenMenus'] = $cMenus[$menu['id']];
                    }
                }
            }
            unset($existMenuIds);
        }
        return ['permissions' => $permissions, 'menus' => $menus];
    }

//    private function getAllActionsInfo()
//    {
//        $permissions = [];
//        $m = [];
//        $menus = [];
//        $cMenus = [];  // 临时存放二级菜单 key为父级菜单的id
//        $rawActions = DB::table('system_actions')
//            -> select('id', 'actionName', 'description', 'menuUrl', 'urls', 'parentId')
//            -> orderBy('weight', 'ASC')
//            -> get();
//        foreach ($rawActions as $rawAction) {
//            $urls = json_decode($rawAction -> urls, true);
//            # 获取权限
//            $permissions = array_merge($permissions, $urls);
//            if ($rawAction -> parentId == 0) {
//                $m[] = [
//                    'id' => $rawAction -> id,
//                    'actionName' => $rawAction -> actionName,
//                    'menuUrl' => $rawAction -> menuUrl,
//                    'childrenMenus' => []
//                ];
//            } else {
//                $cMenus[$rawAction -> parentId][] = [
//                    'id' => $rawAction -> id,
//                    'actionName' => $rawAction -> actionName,
//                    'menuUrl' => $rawAction -> menuUrl,
//                ];
//            }
//        }
//        // 生成菜单列表（二维数组）
//        foreach ($m as $key => $menu) {
//            $menus[$key] = $menu;
//            if (isset($cMenus[$menu['id']])) {
//                $menus[$key]['childrenMenus'] = $cMenus[$menu['id']];
//            }
//        }
//        return ['permissions' => $permissions, 'menus' => $menus];
//    }
//
//    private function getRoleActionsInfoByRoleId($roleId = 0)
//    {
//        $permissions = [];
//        $m = [];
//        $menus = [];
//        $cMenus = [];  // 临时存放二级菜单 key为父级菜单的id
//        if ($roleId == 0) {
//            $rawActions = DB::table('system_actions')
//                -> select('id', 'actionName', 'description', 'menuUrl', 'urls', 'parentId')
//                -> orderBy('weight', 'ASC')
//                -> where('isDelete', 0)
//                -> get();
//        } else {
//            $rawActions = DB::table('system_actions')
//                -> select('system_actions.id', 'system_actions.actionName', 'system_actions.description',
//                    'system_actions.menuUrl', 'system_actions.urls', 'system_actions.parentId')
//                -> leftJoin('system_roles_actions', 'system_roles_actions.aid', '=', 'system_actions.id')
//                -> orderBy('system_actions.weight', 'ASC')
//                -> where('system_actions.isDelete', 0)
//                -> where('system_roles_actions.isDelete', 0)
//                -> get();
//        }
//        if ($rawActions) {
//            foreach ($rawActions as $rawAction) {
//                $urls = json_decode($rawAction -> urls, true);
//                # 获取权限
//                $permissions = array_merge($permissions, $urls);
//                if ($rawAction -> parentId == 0) {
//                    $m[] = [
//                        'id' => $rawAction -> id,
//                        'actionName' => $rawAction -> actionName,
//                        'menuUrl' => $rawAction -> menuUrl,
//                        'childrenMenus' => []
//                    ];
//                } else {
//                    $cMenus[$rawAction -> parentId][] = [
//                        'id' => $rawAction -> id,
//                        'actionName' => $rawAction -> actionName,
//                        'menuUrl' => $rawAction -> menuUrl,
//                    ];
//                }
//            }
//            // 生成菜单列表（二维数组）
//            foreach ($m as $key => $menu) {
//                $menus[$key] = $menu;
//                if (isset($cMenus[$menu['id']])) {
//                    $menus[$key]['childrenMenus'] = $cMenus[$menu['id']];
//                }
//            }
//        }
//        return ['permissions' => $permissions, 'menus' => $menus];
//    }
}
