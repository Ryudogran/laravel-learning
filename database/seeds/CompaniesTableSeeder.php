<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'ADMIN COMPANY',
            'email' => 'admin@gmail.com',
            'logo' => 'admin_logo.png',
            'website' => 'https://laravel-news.com/eloquent-tips-tricks',
        ],
        [
            'name' => 'Random COMPANY',
            'email' => 'random_logo.png',
            'website' => 'https://laravel-news.com/eloquent-tips-tricks',
        ],
    );
}
}
