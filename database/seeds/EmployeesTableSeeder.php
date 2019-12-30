<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'first_name' => 'EMPLOYEE A',
            'last_name' => 'ARSEN',
            'company_id' => 1,
            'email' => 'aaa@gmail.com',
            'phone' => 123213
        ],
        [
            'first_name' => 'EMPLOYEE B',
            'last_name' => 'JULIA',
            'company_id' => 1,
            'email' => 'bbb@gmail.com',
            'phone' => 223452
        ],
    );
    }
}
