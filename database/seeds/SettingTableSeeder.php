<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class SettingTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('settings')->insert([
            'name' => 'Business Name',
            'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint enim quo ipsam libero autem maiores, dicta consequatur! Nobis quod molestias ad voluptas corporis molestiae, labore architecto quibusdam doloremque ab mollitia?',
            'image' => '/no_image.png',
            'currency' => 'QAR',
            'language' => 'en',
            'language_admin' => 'en',
        ]);
    }
}
