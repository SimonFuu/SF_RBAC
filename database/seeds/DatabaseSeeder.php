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
        $this->call(SystemUsersSeeder::class);
        $this->call(SystemActionsSeeder::class);
        $this->call(SystemActionsSeeder::class);
        $this->call(SystemActionsSeeder::class);
        $this->call(SystemActionsSeeder::class);
        $this->call(SystemActionsSeeder::class);
    }
}
