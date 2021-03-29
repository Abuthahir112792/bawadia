<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BranchTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(OrderStatusTableSeeder::class);
        $this->call(PageSeeder::class);
    }
}
