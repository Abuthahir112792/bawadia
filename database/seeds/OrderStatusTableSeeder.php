<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert(
            [ 'name' => 'Pending', 'status' => 1 ],
            [ 'name' => 'Cooking', 'status' => 1 ],
            [ 'name' => 'On Way', 'status' => 1 ],
            [ 'name' => 'Delivered', 'status' => 1 ],
            [ 'name' => 'Reviewed', 'status' => 0 ],
            [ 'name' => 'Cancelled', 'status' => 1 ],
        );
    }
}
