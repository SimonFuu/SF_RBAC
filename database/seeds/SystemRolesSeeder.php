<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SystemRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['roleName' => 'default', 'description' => '系统保留角色，权限最低，仅可访问系统首页'],
            ['roleName' => '超级管理员', 'description' => '超级管理员，拥有系统全部的权限'],
        ];
        DB::beginTransaction();
        try {
            DB::table('system_roles')
                -> insert($data);
            DB::commit();
        } catch (Exception $e) {
            Log::emergency($e -> getMessage());
            DB::rollback();
        }
    }
}
