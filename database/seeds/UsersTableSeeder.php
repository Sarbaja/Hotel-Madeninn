<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_time = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => '$2y$10$1Bj8H6SCbgekGPl/DjGkdOwL8eKk4nVfGfDFmnbWJPNpHk4F7Kamu',//kathmandu123
            'phone' => '9800000000',
            'role' => '1',
            'status' => '1',
            'remember_token' => str_random(10),
            'email_verified_at' => $current_time,
            'created_at' => $current_time,
            'updated_at' => $current_time
        ]);
    }
}
