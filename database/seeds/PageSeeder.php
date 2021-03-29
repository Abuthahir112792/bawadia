<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert(
            
            [
                [
                    'page' => 'about_us',
                    'title' => 'About US',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint enim quo ipsam libero autem maiores, dicta consequatur! Nobis quod molestias ad voluptas corporis molestiae, labore architecto quibusdam doloremque ab mollitia?',
                    'language' => 'en',
                ],
                [
                    'page' => 'privacy',
                    'title' => 'Privecy',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint enim quo ipsam libero autem maiores, dicta consequatur! Nobis quod molestias ad voluptas corporis molestiae, labore architecto quibusdam doloremque ab mollitia?',
                    'language' => 'en',
                ],
                [
                    'page' => 'tnc',
                    'title' => 'Terms and Conditions',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint enim quo ipsam libero autem maiores, dicta consequatur! Nobis quod molestias ad voluptas corporis molestiae, labore architecto quibusdam doloremque ab mollitia?',
                    'language' => 'en',
                ],
                [
                    'page' => 'about_us',
                    'title' => 'About US',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint enim quo ipsam libero autem maiores, dicta consequatur! Nobis quod molestias ad voluptas corporis molestiae, labore architecto quibusdam doloremque ab mollitia?',
                    'language' => 'ar',
                ],
                [
                    'page' => 'privacy',
                    'title' => 'Privecy',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint enim quo ipsam libero autem maiores, dicta consequatur! Nobis quod molestias ad voluptas corporis molestiae, labore architecto quibusdam doloremque ab mollitia?',
                    'language' => 'ar',
                ],
                [
                    'page' => 'tnc',
                    'title' => 'Terms and Conditions',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint enim quo ipsam libero autem maiores, dicta consequatur! Nobis quod molestias ad voluptas corporis molestiae, labore architecto quibusdam doloremque ab mollitia?',
                    'language' => 'ar',
                ],
    
            ]
    );
    }
}
