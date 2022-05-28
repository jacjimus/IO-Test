<?php

namespace Database\Seeders;

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
        DB::table('users')->where('email', 'jacjimus@gmail.com')->delete();

        DB::table('users')->insert([
            'name' => 'James Makau',
            'email' => 'jacjimus@gmail.com',
            'password' => bcrypt('12345'),
            'email_verified_at' => now(),
        ]);
    }
}
