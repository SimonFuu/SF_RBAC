<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SystemActionsSeeder::class);
        $this->call(SystemIconsSeeder::class);
        $this->call(SystemRolesActionsSeeder::class);
        $this->call(SystemRolesSeeder::class);
        $this->call(SystemUsersRolesSeeder::class);
        $this->call(SystemUsersSeeder::class);
    }
}
