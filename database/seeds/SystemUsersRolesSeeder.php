<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SystemUsersRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            DB::table('system_users_roles')
                -> insert(['uid' => 1, 'rid' => 2]);
            DB::commit();
        } catch (Exception $e) {
            Log::emergency($e -> getMessage());
            DB::rollback();
        }
    }
}
