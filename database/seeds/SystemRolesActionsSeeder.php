<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SystemRolesActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["rid"=>1,"aid"=>1],
            ["rid"=>1,"aid"=>2],
            ["rid"=>1,"aid"=>3],
            ["rid"=>1,"aid"=>4],
            ["rid"=>1,"aid"=>5],
            ["rid"=>1,"aid"=>6],
            ["rid"=>1,"aid"=>1],
            ["rid"=>1,"aid"=>2],
            ["rid"=>1,"aid"=>3],
            ["rid"=>1,"aid"=>4],
            ["rid"=>1,"aid"=>5],
            ["rid"=>1,"aid"=>1],
            ["rid"=>1,"aid"=>2],
            ["rid"=>1,"aid"=>3],
            ["rid"=>1,"aid"=>4],
            ["rid"=>1,"aid"=>5],
            ["rid"=>1,"aid"=>1],
            ["rid"=>1,"aid"=>2],
            ["rid"=>1,"aid"=>3],
            ["rid"=>1,"aid"=>4],
            ["rid"=>1,"aid"=>5],
            ["rid"=>1,"aid"=>1],
            ["rid"=>1,"aid"=>2],
            ["rid"=>1,"aid"=>3],
            ["rid"=>1,"aid"=>4],
            ["rid"=>1,"aid"=>5],
            ["rid"=>1,"aid"=>1],
            ["rid"=>1,"aid"=>2],
            ["rid"=>1,"aid"=>3],
            ["rid"=>1,"aid"=>4],
            ["rid"=>1,"aid"=>5],
            ["rid"=>1,"aid"=>6],
            ["rid"=>1,"aid"=>1],
            ["rid"=>1,"aid"=>2],
            ["rid"=>1,"aid"=>3],
            ["rid"=>1,"aid"=>4],
            ["rid"=>1,"aid"=>5],
            ["rid"=>1,"aid"=>6],
            ["rid"=>1,"aid"=>1],
            ["rid"=>1,"aid"=>2],
            ["rid"=>1,"aid"=>3],
            ["rid"=>1,"aid"=>4],
            ["rid"=>1,"aid"=>5],
            ["rid"=>1,"aid"=>6],
            ["rid"=>1,"aid"=>1],
            ["rid"=>1,"aid"=>2],
            ["rid"=>1,"aid"=>3],
            ["rid"=>1,"aid"=>4],
            ["rid"=>1,"aid"=>5],
            ["rid"=>1,"aid"=>6],
            ["rid"=>1,"aid"=>1],
            ["rid"=>1,"aid"=>2],
            ["rid"=>1,"aid"=>3],
            ["rid"=>1,"aid"=>4],
            ["rid"=>1,"aid"=>5],
            ["rid"=>1,"aid"=>6],
            ["rid"=>1,"aid"=>7],
            ["rid"=>1,"aid"=>1],
            ["rid"=>1,"aid"=>2],
            ["rid"=>1,"aid"=>3],
            ["rid"=>1,"aid"=>4],
            ["rid"=>1,"aid"=>5],
            ["rid"=>1,"aid"=>6],
            ["rid"=>1,"aid"=>7],
            ["rid"=>1,"aid"=>1],
            ["rid"=>1,"aid"=>2],
            ["rid"=>1,"aid"=>3],
            ["rid"=>1,"aid"=>4],
            ["rid"=>1,"aid"=>5],
            ["rid"=>1,"aid"=>6],
            ["rid"=>2,"aid"=>7],
            ["rid"=>2,"aid"=>1],
            ["rid"=>2,"aid"=>2],
            ["rid"=>2,"aid"=>3],
            ["rid"=>2,"aid"=>4],
            ["rid"=>2,"aid"=>5],
            ["rid"=>2,"aid"=>6],
            ["rid"=>1,"aid"=>7],
            ["rid"=>1,"aid"=>1],
            ["rid"=>1,"aid"=>2],
            ["rid"=>1,"aid"=>3],
            ["rid"=>1,"aid"=>4],
            ["rid"=>1,"aid"=>5],
            ["rid"=>1,"aid"=>6],
            ["rid"=>1,"aid"=>7],
            ["rid"=>1,"aid"=>7],
            ["rid"=>2,"aid"=>7],
            ["rid"=>2,"aid"=>1],
            ["rid"=>2,"aid"=>2],
            ["rid"=>2,"aid"=>3],
            ["rid"=>2,"aid"=>4],
            ["rid"=>2,"aid"=>5],
            ["rid"=>2,"aid"=>6]
        ];
        DB::beginTransaction();
        try {
            DB::table('system_roles_actions')
                -> insert($data);
            DB::commit();
        } catch (Exception $e) {
            Log::emergency($e -> getMessage());
            DB::rollback();
        }
    }
}
