<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminExist = DB::table('system_users')
            -> where('id', 1) -> count();
        if ($adminExist) {
            DB::table('system_users')
                -> where('id', 1)
                -> update([
                    'username' => 'admin',
                    'password' => bcrypt(111111),
                    'name' => '管理员',
                    'gender' => 0,
                    'isActive' => 1,
                ]);
        } else {
            DB::table('system_users')
                -> insert([
                    'username' => 'admin',
                    'password' => bcrypt(111111),
                    'name' => '管理员',
                    'gender' => 0,
                    'isActive' => 1,
                ]);
        }
    }
}
